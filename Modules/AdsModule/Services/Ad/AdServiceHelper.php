<?php

namespace Modules\AdsModule\Services\Ad;


use Modules\AdsModule\Entities\Ad;

trait AdServiceHelper
{

    protected function validationCreate($data)
    {
        return validator($data,[
            'title' => 'required',
            'ad_image' =>  'required|image',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);
    }
    protected function validationUpdate($data)
    {
        return validator($data,[
            'title' => 'required',
            'ad_image' => 'nullable|image',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'user_id' => 'nullable|exists:users,id',
            'id' => 'required|exists:ads,id'
        ]);
    }
    protected function validationUpdateActivity($data)
    {
        $activites = collect(Ad::AD_ACTIVITY)->values()->filter(function ($i){
            return in_array($i,[0,1]);
        })->values()->implode(',');
        return validator($data,[
            'id' => 'required|exists:ads,id',
            'active' => "required|in:$activites"
        ]);
    }


}
