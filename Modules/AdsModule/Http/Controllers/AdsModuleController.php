<?php

namespace Modules\AdsModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AdsModule\Services\Ad\AdService;
use Modules\AdsModule\Services\User\UserService;

class AdsModuleController extends Controller
{
    protected $userService;
    protected $adService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->adService = new AdService();
    }
    public function index(Request $request)
    {
        $request_data = $request->all();
        $ads = $this->adService->all($request_data)['data'];
        $users= $this->userService->all([])['data'];
        return view('adsmodule::Ads.index', compact('users', 'ads'));
    }
    public function create()
    {
        $users = $this->userService->all([])['data'];
        return view('adsmodule::Ads.create', compact( 'users'));
    }
    public function store(Request $request)
    {
        $op = $this->adService->create($request->all());
        if ($op) {
            return redirect(url('/dashboard/ads'));
        }
        return back()->withErrors($response['data']['validation_errors'] ?? [])->withInput();
    }
    public function edit($id)
    {
        $ad = $this->adService->find($id)['data'] ?? null;
        if (!$ad) return back()->with('error', __('trans.not_found'));
        $users = $this->userService->all([])['data'];
        $activites =  [
            0 => 0,
            1 => 1,
        ];
        return view('adsmodule::Ads.edit', compact('ad', 'users','activites'));
    }
    public function update(Request $request, $id)
    {
        $request->request->add(['id' => $id]);
        $op = $this->adService->update($request->all());
        if($op){
            return redirect(url('/dashboard/ads'));
        }else{
            return back()->withErrors($response['data']['validation_errors'] ?? [])->withInput();
        }

    }
    public function delete(Request $request)
    {
        $op =$this->adService->delete($request->all());
        if($op){
            return redirect(url('/dashboard/ads'));
        }
    }
}
