<?php
namespace Modules\AdsModule\Services\User;

use Illuminate\Support\Facades\DB;
use Modules\AdminModule\Exports\AdminExport;
use Modules\AdsModule\Exports\UsersExport;
use Modules\AdsModule\Repositories\User\UserRepository;
use Modules\AdsModule\Traits\UploadHelper;


class UserService
{
    use UserServiceHelper,UploadHelper;

    protected $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
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
            $user = $this->userRepository->create($data);
            DB::commit();
            return return_msg(true,'Success',$user);
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
    public function update(array $data){
        try {
            DB::beginTransaction();
            //validate Data
            $validation = $this->validationUpdate($data);
            if ($validation->fails()) {
                return return_msg(false, 'Validation Errors', [
                    'validation_errors' => $validation->getMessageBag()->getMessages(),
                ]);
            }
            $user = $this->userRepository->update($data);
            DB::commit();
            return return_msg(true,'Success',$user);
        }
        catch (\Exception $exception){
            DB::rollBack();
            handleExceptionDD($exception);
            return return_msg(false,'Success',[
                'validation_errors' => [
                    'error_id' => [__('messages.server_error')],
                ],
            ]);
        }
    }
    public function updateActivity(array $data)
    {
        try {
            DB::beginTransaction();
            //validate Data
            $validation = $this->validationUpdateActivity($data);
            if ($validation->fails()){
                return return_msg(false,'Validation Errors',[
                    'validation_errors' => $validation->getMessageBag()->getMessages(),
                ]);
            }
            $updated_data = [
                'active' => $data['active'],
                'id' => $data['id'],
            ];
            $user = $this->userRepository->update($updated_data);
            DB::commit();
            return return_msg(true,'Success',$user);
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
    public function all(array $data){
        try {
            $users =$this->userRepository->all($data);
            return return_msg(true,'Success',$users);
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
            $user = $this->userRepository->find($id);
            return return_msg($user ? true : false,'Success',$user);
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
            $this->userRepository->delete($id);
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
    public function handleExportAdminSample()
    {
        return \Excel::download(new UsersExport(), 'Users.xlsx');
    }
    public function exportPDFSample()
    {
        return \Excel::download(new UsersExport(), 'Users.pdf');
    }
}
