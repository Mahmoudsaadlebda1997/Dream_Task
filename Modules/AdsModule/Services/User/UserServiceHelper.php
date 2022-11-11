<?php

namespace Modules\AdsModule\Services\User;


use Modules\AdsModule\Entities\User;

trait UserServiceHelper
{

    protected function validationCreate($data)
    {
        return validator($data,[
            'name' => 'required',
            'ads_count' => 'nullable',
            'email' => 'required|email|unique:users,email,id',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
        ]);
    }
    protected function validationUpdate($data)
    {
        return validator($data,[
            'name' => 'required',
            'ads_count' => 'nullable',
            'email' => 'nullable|email|unique:users,email,id',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'id' => 'required|exists:users,id'
        ]);
    }
    protected function validationUpdateActivity($data)
    {
        $activites = collect(User::USER_ACTIVITY)->values()->filter(function ($i){
            return in_array($i,[0,1]);
        })->values()->implode(',');
        return validator($data,[
            'id' => 'required|exists:users,id',
            'active' => "required|in:$activites"
        ]);
    }


}
