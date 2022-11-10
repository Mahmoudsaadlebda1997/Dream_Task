<?php


namespace Modules\CountryModule\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CountryModule\Services\Country\CountryService;
use Modules\CountryModule\Transformers\CountryResource;

class CountryApiController extends Controller
{
    protected $countryService;

    public function __construct()
    {
        $this->countryService = new CountryService();
    }

    public function index(Request $request)
    {
        $countries= $this->countryService->all($request->all());
        $countries = CountryResource::collection($countries['data'] ?? null)->response()->getData(true);
        return return_response(return_msg(true,"Success",$countries));
    }
    public function create(Request $request)
    {
        $data =$this->countryService->create($request->all());
        if($data['status']){
            $country = new CountryResource($data['data']);
            return return_response(return_msg(true,"Success",$country));
        }
        return return_response($data);
    }
    public function update(Request $request,$id)
    {
        $request->request->add(['id'=> $id]);
        $data = $this->countryService->update($request->all());
        if($data['status']){
            $country = new CountryResource($data['data']);
            return return_response(return_msg(true,"Success",$country));
        }
        return return_response($data);
    }
    public function find($id)
    {
        $data = $this->countryService->find($id);
        if($data['status']){
            $country = new CountryResource($data['data']);
            return return_response(return_msg(true,"Success",$country));
        }
        return return_response($data);
    }
    public function delete(Request $request,$id)
    {
        $request->request->add(['ids'=>[$id]]);
        $response = $this->countryService->delete($request->all());
        return return_response($response);
    }
}
