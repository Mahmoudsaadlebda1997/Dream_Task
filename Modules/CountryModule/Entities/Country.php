<?php

namespace Modules\CountryModule\Entities;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    protected $fillable = ['name'];

    public function cities(){
        return $this->hasMany(City::class,'country_id');
    }
    public function scopeSearch($query,$term){
        return $query->where(function ($q)use($term){
            return $q->where('name','LIKE',"%$term%");
        });
    }
}
