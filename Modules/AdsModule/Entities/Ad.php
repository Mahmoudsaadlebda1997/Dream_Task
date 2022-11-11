<?php

namespace Modules\AdsModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Modules\AdsModule\Traits\PathHelper;

class Ad extends Model
{
    use PathHelper;

    const AD_ACTIVITY= [
        0=>0,
        1=>1,
    ];
    protected $fillable = ['title','user_id','ad_image','start_date','end_date','active'];

    public function scopeSearch($query,$term){
        return $query->where(function ($q)use($term){
            return $q->where('title','LIKE',"%$term%");
        });
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    protected $appends = ['ad_image_path'];

    public function getAdImagePathAttribute()
    {
        if($this->ad_image){
            return Storage::url($this->ad_image);
        }
        return \Avatar::create($this->title)->toBase64();

    }
}
