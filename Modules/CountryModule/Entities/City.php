<?php

namespace Modules\CountryModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    protected $fillable = ['name','country_id'];

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function scopeSearch($query,$term){
        return $query->where(function ($q)use($term){
            return $q->where('name','LIKE',"%$term%");
        });
    }
}
