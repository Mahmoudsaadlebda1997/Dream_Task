<?php
namespace Modules\AdminModule\Repositories\Admin;

trait AdminRepoHelper
{
    public function filter(&$collections,$data){
        if (($data['query'] ?? null)){
            $collections->search($data['query']);
        }
    }
}
