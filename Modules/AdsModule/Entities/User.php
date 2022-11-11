<?php

namespace Modules\AdsModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\CountryModule\Entities\City;
use Modules\CountryModule\Entities\Country;

class User extends Model
{

    const USER_ACTIVITY= [
        0=>0,
        1=>1,
    ];
    protected $fillable = ['name','email','country_id','city_id','ads_count','active'];

    public function scopeSearch($query,$term){
        return $query->where(function ($q)use($term){
            return $q->where('name','LIKE',"%$term%")
                ->orWhere('email','LIKE',"%$term%");
        });
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function ads(){
        return $this->hasMany(Ad::class,'user_id');
    }
}
