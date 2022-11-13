<?php


namespace Modules\AdsModule\Traits;


use Illuminate\Support\Facades\Storage;
use Vimeo\Laravel\Facades\Vimeo;

trait UploadHelper
{

    protected function uploadFile($file,$path)
    {
        $file_name =  rand() . time() . '.' . $file->guessExtension();
        $data['name'] = 'uploads/'.$path.'/'.$file_name;
        $data['mime_type'] = $file->getClientMimeType();
        $data['extension'] = $file->getClientOriginalExtension();
        $data['placeholder'] = $file->getClientOriginalName();

        Storage::disk(env('FILESYSTEM_DRIVER','local'))
            ->put($data['name'],file_get_contents($file));
        return $data;
    }
    protected function uploadVimeoVideo($file)
    {
        $temp_name  = rand() . time() . '.' . $file->getClientOriginalExtension();
        return Vimeo::upload($file,
            [
            'name' => $temp_name,
            'privacy' => [
                'view' => 'disable',
            ]
        ]
        );
    }

    protected function removeFile($paths)
    {
        try {
            Storage::disk(env('FILESYSTEM_DISK','local'))->delete($paths);
        }catch (\Exception $exception){

        }

    }
    protected function removeFileVimeo($path)
    {
        try {
//            Vimeo::request($path,[],'DELETE');
        }catch (\Exception $exception){

        }

    }
}
