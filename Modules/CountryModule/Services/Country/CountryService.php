<?php

namespace Modules\CountryModule\Services\Country;

use Illuminate\Support\Facades\DB;
use Modules\CountryModule\Repositories\Country\CountryRepository;

class CountryService
{
    use CountryServiceHelper;
    private $countryRepository;

    public function __construct()
    {
        $this->countryRepository = new CountryRepository();
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
            $country = $this->countryRepository->create($data);
            DB::commit();

            return return_msg(true,'Success',$country);
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
            $country = $this->countryRepository->update($data);
            DB::commit();
            return return_msg(true,'Success',$country);
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
            $country = $this->countryRepository->find($id);
            return return_msg($country ? true : false,'Success',$country);
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
        // Check Before Delete
        $countries = $this->countryRepository->findByIds($data['ids'] ?? null);

        foreach ($countries as $country){
            if ($country->cities->count()){
                return return_msg(false,'Validation',[
                    'validation_errors' => [
                        'error_id' => [
                            __('messages.country_delete')
                        ]
                    ]
                ]);
            }
        }
        $item = $this->countryRepository->delete($data['ids'] ?? []);
        if ($item){
            return return_msg(true,'Success');
        }
        return return_msg(false,'Success',$item);

    }
    public function all(array $data){
        try {
            $countries =$this->countryRepository->all($data);
            return return_msg(true,'Success',$countries);

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
