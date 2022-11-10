<?php

namespace Modules\AdminModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{

    protected $fillable = ['name','email','password','privileges','remember_token'];
    protected $hidden = ['password', 'remember_token'];

    public function scopeSearch($query,$term){
        return $query->where(function ($q)use($term){
            return $q->where('name','LIKE',"%$term%")
                ->orWhere('email','LIKE',"%$term%")
                ->orWhere('privileges','LIKE',"%$term%");
        });
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
