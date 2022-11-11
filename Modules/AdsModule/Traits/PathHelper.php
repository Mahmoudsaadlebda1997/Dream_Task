<?php


namespace Modules\AdsModule\Traits;


use Illuminate\Support\Facades\Storage;

trait PathHelper
{

    function getAdImagePathAttribute(){
        if($this->ad_image){
            return Storage::url($this->ad_image);
        }
        return null;
    }


}
