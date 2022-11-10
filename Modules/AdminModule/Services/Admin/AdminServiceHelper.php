<?php

namespace Modules\AdminModule\Services\Admin;

trait AdminServiceHelper{

    function validationLogin($data){
        return validator($data,[
            'email' => 'required',
            'password' => 'required|min:6',
        ]);
    }
    function validationCreate($data){
        return validator($data,[
            'name'=>'required',
            'password' =>'required|min:12|confirmed',
            'privileges' =>'required',
            'email' => 'required|email|unique:admins,email,id',
        ]);
    }
}
