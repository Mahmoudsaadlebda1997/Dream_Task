<?php

namespace Modules\CountryModule\Repositories\Country;

trait CountryRepoHelper
{
    public function filter(&$collections,$data){
        if (($data['query'] ?? null)){
            $collections->search($data['query']);
        }
    }
}
