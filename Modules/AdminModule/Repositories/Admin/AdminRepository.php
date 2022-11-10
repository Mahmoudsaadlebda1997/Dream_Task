<?php

namespace Modules\AdminModule\Repositories\Admin;

use Modules\AdminModule\Entities\Admin;

class AdminRepository
{
    use AdminRepoHelper;

    private $adminModel;

    public function __construct()
    {
        $this->adminModel = new Admin();
    }

    public function create(array $data){
        $admin = $this->adminModel->create($data);
        return $admin->fresh();
    }
    public function update(array $data){

        $admin = $this->adminModel->find($data['id'] ?? null);
        $admin->update($data);
        return $admin->fresh();
    }
    public function find($id){
        return $this->adminModel->whereId($id)->first();
    }
    public  function findByIds($ids){
        return $this->adminModel->whereIn('id',$ids)->get();
    }
    public function delete($ids){
        return $this->adminModel->whereIn('id',$ids)->delete();
    }
    public function all(array $data){
        $admins = $this->adminModel->orderBy('id');
        $this->filter($admins,$data);
        return getCaseCollection($admins,$data);
    }
}
