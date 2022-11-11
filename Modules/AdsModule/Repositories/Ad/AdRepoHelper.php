<?php

namespace Modules\AdsModule\Repositories\Ad;


trait AdRepoHelper {

    protected function filter(&$collections,$data){
        if($data['query'] ?? null){
            $collections->search($data['query']);
        }
        if($data['user_id'] ?? null){
            $collections->where('user_id',$data['user_id']);
        }
        if($data['active'] ?? null){
            $collections->where('active',$data['active']);
        }
        if (($data['start_date'] ?? null)){
            $collections->where('start_date','>=',$data['start_date']);
        }
        if (($data['end_date'] ?? null)){
            $collections->where('end_date','<=',$data['end_date']);
        }
    }
}
