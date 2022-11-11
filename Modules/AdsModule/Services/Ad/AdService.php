<?php
namespace Modules\AdsModule\Services\Ad;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\AdsModule\Repositories\Ad\AdRepository;
use Modules\AdsModule\Traits\UploadHelper;


class AdService
{
    use AdServiceHelper,UploadHelper;

    protected $adRepository;

    public function __construct()
    {
        $this->adRepository = new AdRepository();
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
            !($data['ad_image'] ?? null) ? : $data['ad_image'] = ($this->uploadFile($data['ad_image'] ?? null,'ads')['name'] ?? null);
            $ad = $this->adRepository->create($data);
            DB::commit();
            return return_msg(true,'Success',$ad);
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

            if ($data['ad_image'] ?? null){
                // unlink
                $ad = $this->adRepository->find($data['id']);
                $this->removeFile([$ad->ad_image]);
                $data['ad_image'] = $this->uploadFile($data['ad_image'] ?? null,'ads')['name'] ?? null;
            }else{
                unset($data['ad_image']);
            }
            $ad = $this->adRepository->update($data);
            DB::commit();
            return return_msg(true,'Success',$ad);
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
            $ad = $this->adRepository->update($updated_data);
            DB::commit();
            return return_msg(true,'Success',$ad);
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
            $ads =$this->adRepository->all($data);
            return return_msg(true,'Success',$ads);

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
            $ad = $this->adRepository->find($id);
            return return_msg($ad ? true : false,'Success',$ad);
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
            // unlink
            $ad = $this->adRepository->find($id);
            if($ad->ad_image){
                Storage::delete($ad->ad_image);
            }
            $this->adRepository->delete($id);
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
