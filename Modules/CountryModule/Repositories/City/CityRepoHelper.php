<?php

namespace Modules\CountryModule\Repositories\City;

trait CityRepoHelper
{
    public function filter(&$collections,$data){
        if (($data['query'] ?? null)){
            $collections->search($data['query']);
        }
        if (isset($data['country_id'])){
            $collections->where('country_id',$data['country_id']);
        }
    }
}
