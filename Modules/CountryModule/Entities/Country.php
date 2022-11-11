<?php

namespace Modules\CountryModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\AdsModule\Entities\User;

class Country extends Model
{

    protected $fillable = ['name'];

    public function cities(){
        return $this->hasMany(City::class,'country_id');
    }
    public function users(){
        return $this->hasMany(User::class,'country_id');
    }
    public function scopeSearch($query,$term){
        return $query->where(function ($q)use($term){
            return $q->where('name','LIKE',"%$term%");
        });
    }
}
