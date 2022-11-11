<?php

namespace Modules\AdsModule\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AdsModule\Services\Ad\AdService;
use Modules\AdsModule\Transformers\AdsResource;

class AdApiController extends Controller
{
    protected $adService;

    public function __construct()
    {
        $this->adService = new AdService();
    }

    public function index(Request $request)
    {
//        $userID = auth('user_id')->user()->id;
//        $request->request->add(["user_id"=>$userID]);
        $ads = $this->adService->all($request->all());
        $ads = AdsResource::collection($ads['data'] ?? null)->response()->getData(true);
        return return_response(return_msg(true,"Success",$ads));

    }

    public function create(Request $request)
    {
        $data =$this->adService->create($request->all());
        if($data['status']){
            $ad = new AdsResource($data['data']);
            return return_response(return_msg(true,"Success",$ad));
        }
        return return_response($data);

    }
    public function update(Request $request,$id)
    {
        $request->request->add(['id'=> $id]);
        $data = $this->adService->update($request->all());
        if($data['status']){
            $ad = new AdsResource($data['data']);
            return return_response(return_msg(true,"Success",$ad));
        }
        return return_response($data);
    }
    public function updateActivity(Request $request,$id)
    {
        $request->request->add(['id'=> $id]);
        $data = $this->adService->updateActivity($request->all());
        if($data['status']){
            $ad = new AdsResource($data['data']);
            return return_response(return_msg(true,"Success",$ad));
        }
        return return_response($data);
    }
    public function find($id)
    {
        $data = $this->adService->find($id);
        if($data['status']){
            $data = new AdsResource($data['data']);
            return return_response(return_msg(true,"Success",$data));
        }
        return return_response($data);
    }
    public function delete(Request $request,$id)
    {
        $request->request->add(['ids'=>[$id]]);
        $response = $this->adService->delete($request->all());
        return return_response($response);
    }
}
