<?php

namespace Modules\CountryModule\Services\City;

trait CityServiceHelper
{

    protected function validationCreate($data){
        return validator($data,[
            'name' => 'required',
            'country_id' => 'required|exists:countries,id'
        ]);
    }

    protected function validationUpdate($data){
        return validator($data,[
            'name' => 'required',
            'country_id' => 'required|exists:countries,id',
            'id' =>'required|exists:cities,id'
        ]);
    }
}
