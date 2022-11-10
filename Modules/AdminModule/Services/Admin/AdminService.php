<?php
namespace Modules\AdminModule\Services\Admin;

use Illuminate\Support\Facades\DB;
use Modules\AdminModule\Repositories\Admin\AdminRepository;
use Illuminate\Support\Facades\Auth;


class AdminService
{
    use AdminServiceHelper;

    protected $adminRepository;

    public function __construct()
    {
        $this->adminRepository = new AdminRepository();
    }

    public function login(array $data)
    {
        $validation = $this->validationLogin($data);
        if ($validation->fails()){
            return return_msg(false,'Validation Errors',[
                'validation_errors' => $validation->getMessageBag()->getMessages(),
            ]);
        }
        $remember = ($data['remember_token'] ?? null) ? true : false;

        if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']],$remember)) {
            $admin = auth('admin')->user();
            $token = auth('admin_api')->login($admin);
            return return_msg(true,'Success',compact('admin','token'));
        }

        return return_msg(false,'Validation Errors',[
            'validation_errors' => [
                'username' => [__('messages.login_error')]
            ],
        ]);
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return return_msg(true,'Success');

    }
    public function create(array $data){
        try {
            DB::beginTransaction();
            //validate Data
            $validation = $this->validationCreate($data);
            if ($validation->fails()) {
                return return_msg(false, 'Validation Errors', [
                    'validation_errors' => $validation->getMessageBag()->getMessages(),
                ]);
            }
            $data['password'] = bcrypt($data['password']);
            $admin = $this->adminRepository->create($data);
            DB::commit();
            return return_msg(true,'Success',$admin);
        }
        catch (\Exception $exception){
            DB::rollBack();
            handleExceptionDD($exception);
            return return_msg(false,'Success',[
                'validation_errors' => [
                    'username' => [__('messages.server_error')],
                    'error_id' => [__('messages.server_error')],
                ],
            ]);
        }
    }
    public function all(array $data){
        try {
            $admins =$this->adminRepository->all($data);
            return return_msg(true,'Success',$admins);

        }catch (\Exception $exception){
            DB::rollBack();
            handleExceptionDD($exception);
            return return_msg(false,'Success',[
                'validation_errors' => [
                    'error_id' => [__('messages.server_error')],
                ],
            ]);
        }
    }
    public function find($id){
        try {
            $admin = $this->adminRepository->find($id);
            return return_msg($admin ? true : false,'Success',$admin);
        }catch (\Exception $exception){
            DB::rollBack();
            handleExceptionDD($exception);
            return return_msg(false,'Success',[
                'validation_errors' => [
                    'error_id' => [__('messages.server_error')],
                ],
            ]);
        }
    }
    public function delete($id){
        try {
            $this->adminRepository->delete($id);
            return return_msg(true,'Success');
        }catch (\Exception $exception){
            DB::rollBack();
            handleExceptionDD($exception);
            return return_msg(false,'Success',[
                'validation_errors' => [
                    'error_id' => [__('messages.server_error')],
                ],
            ]);
        }
    }
}
