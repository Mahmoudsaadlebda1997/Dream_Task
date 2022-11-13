<?php

namespace Modules\AdsModule\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AdsModule\Services\User\UserService;
use Modules\CountryModule\Services\City\CityService;
use Modules\CountryModule\Services\Country\CountryService;

class UserModuleController extends Controller
{
    protected $countryService;
    protected $userService;
    protected $cityService;

    public function __construct()
    {
        $this->countryService = new CountryService();
        $this->userService = new UserService();
        $this->cityService = new CityService();
    }
    public function index(Request $request)
    {
        $request->request->add(['paginated' => 1]);
        $request_data = $request->all();
        $users = $this->userService->all($request_data)['data'];
        $cities = $this->cityService->all([])['data'];
        $countries = $this->countryService->all([])['data'];
        return view('adsmodule::User.index', compact('users', 'cities', 'countries'));
    }
    public function create()
    {
        $countries = $this->countryService->all([])['data'];
        $cities = $this->cityService->all([])['data'];
        return view('adsmodule::User.create', compact( 'countries', 'cities'));
    }
    public function store(Request $request)
    {
        $op = $this->userService->create($request->all());
        if ($op) {
        return redirect(url('/dashboard/users'));
        }
        return back()->withErrors($response['data']['validation_errors'] ?? [])->withInput();
    }
    public function edit($id)
    {
        $user = $this->userService->find($id)['data'] ?? null;
        if (!$user) return back()->with('error', __('trans.not_found'));
        $countries = $this->countryService->all([])['data'];
        $cities = $this->cityService->all([])['data'];
        $activites =  [
            0 => 0,
            1 => 1,
        ];
        return view('adsmodule::User.edit', compact('user', 'countries', 'cities','activites'));
    }
    public function update(Request $request, $id)
    {
        $request->request->add(['id' => $id]);
        $op = $this->userService->update($request->all());
        if($op){
        return redirect(url('/dashboard/users'));
        }else{
        return back()->withErrors($response['data']['validation_errors'] ?? [])->withInput();
        }

    }
    public function delete(Request $request)
    {
        $op =$this->userService->delete($request->all());
        if($op){
            return redirect(url('/dashboard/users'));
        }
    }
    public function getDownloadFileUserXL(Request $request)
    {
        return $this->userService->handleExportAdminSample();
    }
    public function exportPDF(Request $request)
    {
        return $this->userService->exportPDFSample();
    }


}
