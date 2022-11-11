<?php

namespace Modules\CountryModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\AdsModule\Entities\User;

class City extends Model
{
    protected $fillable = ['name','country_id'];

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function users(){
        return $this->hasMany(User::class,'city_id');
    }
    public function scopeSearch($query,$term){
        return $query->where(function ($q)use($term){
            return $q->where('name','LIKE',"%$term%");
        });
    }
}
