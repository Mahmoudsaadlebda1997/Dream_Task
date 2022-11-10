<?php

namespace Modules\CountryModule\Services\City;

use Illuminate\Support\Facades\DB;
use Modules\CountryModule\Repositories\City\CityRepository;

class CityService
{
    use CityServiceHelper;
    private $cityRepository;

    public function __construct()
    {
        $this->cityRepository = new CityRepository();
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
            $city = $this->cityRepository->create($data);
            DB::commit();
            return return_msg(true,'Success',$city);
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
            $city = $this->cityRepository->update($data);
            DB::commit();
            return return_msg(true,'Success',$city);
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
    public function find($id){
        try {
            $city = $this->cityRepository->find($id);
            return return_msg($city ? true : false,'Success',$city);
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
    public function delete(array $data)
    {

        $item = $this->cityRepository->delete($data['ids'] ?? []);
        if ($item){
            return return_msg(true,'Success');
        }
        return return_msg(false,'Success',$item);

    }
    public function all(array $data){
        try {
            $admins =$this->cityRepository->all($data);
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
}
