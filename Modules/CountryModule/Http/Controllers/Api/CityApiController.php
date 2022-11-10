<?php


namespace Modules\CountryModule\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CountryModule\Services\City\CityService;
use Modules\CountryModule\Transformers\CityResource;

class CityApiController extends Controller
{
    protected $cityService;

    public function __construct()
    {
        $this->cityService = new CityService();
    }

    public function index(Request $request)
    {
        $cities= $this->cityService->all($request->all());
        $cities = CityResource::collection($cities['data'] ?? null)->response()->getData(true);
        return return_response(return_msg(true,"Success",$cities));
    }
    public function create(Request $request)
    {
        $data =$this->cityService->create($request->all());
        if($data['status']){
            $city = new CityResource($data['data']);
            return return_response(return_msg(true,"Success",$city));
        }
        return return_response($data);
    }
    public function update(Request $request,$id)
    {
        $request->request->add(['id'=> $id]);
        $data = $this->cityService->update($request->all());
        if($data['status']){
            $city = new CityResource($data['data']);
            return return_response(return_msg(true,"Success",$city));
        }
        return return_response($data);
    }
    public function find($id)
    {
        $data = $this->cityService->find($id);
        if($data['status']){
            $city = new CityResource($data['data']);
            return return_response(return_msg(true,"Success",$city));
        }
        return return_response($data);
    }
    public function delete(Request $request,$id)
    {
        $request->request->add(['ids'=>[$id]]);
        $response = $this->cityService->delete($request->all());
        return return_response($response);
    }
}
