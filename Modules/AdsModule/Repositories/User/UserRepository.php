<?php

namespace Modules\AdsModule\Repositories\User;



use Modules\AdsModule\Entities\User;

class UserRepository
{
    use UserRepoHelper;

    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }
    public function create(array $data)
    {
        $item =$this->userModel->create($data);
        return $item->fresh();
    }
    public function update(array $data)
    {
        $item = $this->userModel->find($data['id']);
        $item->update($data);
        return $item->fresh();
    }
    public function find($id)
    {
        return $item = $this->userModel->whereId($id)->with(['country','city','ads'])->first();
    }
    public function delete($id)
    {
        $item = $this->userModel->whereId($id)->first();
        return $item->delete();
    }
    public function all(array $data)
    {
        $items = $this->userModel->orderByDesc('id')->with(['country','city','ads']);
        $this->filter($items,$data);
        return getCaseCollection($items,$data);
    }
}
