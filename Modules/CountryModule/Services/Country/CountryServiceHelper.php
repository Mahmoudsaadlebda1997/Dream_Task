<?php

namespace Modules\CountryModule\Services\Country;

trait CountryServiceHelper
{

    protected function validationCreate($data){
        return validator($data,[
            'name' => 'required'
        ]);
    }

    protected function validationUpdate($data){
        return validator($data,[
            'name' => 'required',
            'id' =>'required|exists:countries,id'
        ]);
    }
}
