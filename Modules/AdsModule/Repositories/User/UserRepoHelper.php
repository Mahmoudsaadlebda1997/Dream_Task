<?php

namespace Modules\AdsModule\Repositories\User;


trait UserRepoHelper {

    protected function filter(&$collections,$data){
        if($data['query'] ?? null){
            $collections->search($data['query']);
        }
        if($data['country_id'] ?? null){
            $collections->where('country_id',$data['country_id']);
        }
        if($data['city_id'] ?? null){
            $collections->where('city_id',$data['city_id']);
        }
        if($data['ads_count'] ?? null){
            $collections->where('ads_count',$data['ads_count']);
        }
        if($data['active'] ?? null){
            $collections->where('active',$data['active']);
        }
    }
}
