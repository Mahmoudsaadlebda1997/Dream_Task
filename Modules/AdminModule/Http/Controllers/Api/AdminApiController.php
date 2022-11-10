<?php


namespace Modules\AdminModule\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AdminModule\Services\Admin\AdminService;
use Modules\AdminModule\Transformers\AdminResource;

class AdminApiController extends Controller
{
    protected $adminService;

    public function __construct()
    {
        $this->adminService = new AdminService();
    }

    public function index(Request $request)
    {
        $admins = $this->adminService->all($request->all());
        $admins = AdminResource::collection($admins['data'] ?? null)->response()->getData(true);
        return return_response(return_msg(true,"Success",$admins));
    }
    public function login(Request $request)
    {
        $response =  $this->adminService->login($request->all());
        if($response['status']){
            $admin = new AdminResource($response['data']['admin']);
            $token =$response['data']['token'];
            return return_response(return_msg(true,"Success",compact('admin','token')));
        }
        return return_response($response);
    }

    public function create(Request $request)
    {
        $data =$this->adminService->create($request->all());
        if($data['status']){
            $admin = new AdminResource($data['data']);
            return return_response(return_msg(true,"Success",$admin));
        }
        return return_response($data);
    }
    public function find($id)
    {
        $data = $this->adminService->find($id);
        if($data['status']){
            $admin = new AdminResource($data['data']);
            return return_response(return_msg(true,"Success",$admin));
        }
        return return_response($data);
    }
    public function delete(Request $request,$id)
    {
        $request->request->add(['ids'=>[$id]]);
        $response = $this->adminService->delete($request->all());
        return return_response($response);
    }
}
