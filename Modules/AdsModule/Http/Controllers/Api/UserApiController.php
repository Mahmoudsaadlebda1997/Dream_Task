<?php

namespace Modules\AdsModule\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AdsModule\Services\User\UserService;
use Modules\AdsModule\Transformers\UsersResource;

class UserApiController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index(Request $request)
    {
        $users = $this->userService->all($request->all());
        $users = UsersResource::collection($users['data'] ?? null)->response()->getData(true);
        return return_response(return_msg(true,"Success",$users));

    }

    public function create(Request $request)
    {
        $data =$this->userService->create($request->all());
        if($data['status']){
            $user = new UsersResource($data['data']);
            return return_response(return_msg(true,"Success",$user));
        }
        return return_response($data);

    }
    public function update(Request $request,$id)
    {
        $request->request->add(['id'=> $id]);
        $data = $this->userService->update($request->all());
        if($data['status']){
            $user = new UsersResource($data['data']);
            return return_response(return_msg(true,"Success",$user));
        }
        return return_response($data);
    }
    public function updateActivity(Request $request,$id)
    {
        $request->request->add(['id'=> $id]);
        $data = $this->userService->updateActivity($request->all());
        if($data['status']){
            $user = new UsersResource($data['data']);
            return return_response(return_msg(true,"Success",$user));
        }
        return return_response($data);
    }
    public function find($id)
    {
        $data = $this->userService->find($id);
        if($data['status']){
            $data = new UsersResource($data['data']);
            return return_response(return_msg(true,"Success",$data));
        }
        return return_response($data);
    }
    public function delete(Request $request,$id)
    {
        $request->request->add(['ids'=>[$id]]);
        $response = $this->userService->delete($request->all());
        return return_response($response);
    }
}
