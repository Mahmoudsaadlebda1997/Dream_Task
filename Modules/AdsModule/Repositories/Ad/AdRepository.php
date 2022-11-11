<?php

namespace Modules\AdsModule\Repositories\Ad;


use Modules\AdsModule\Entities\Ad;

class AdRepository
{
    use AdRepoHelper;

    private $adModel;

    public function __construct()
    {
        $this->adModel = new Ad();
    }
    public function create(array $data)
    {
        $item =$this->adModel->create($data);
        return $item->fresh();
    }
    public function update(array $data)
    {
        $item = $this->adModel->find($data['id']);
        $item->update($data);
        return $item->fresh();
    }
    public function find($id)
    {
        return $item = $this->adModel->whereId($id)->with(['user'])->first();
    }
    public function delete($id)
    {
        $item = $this->adModel->whereId($id)->first();
        return $item->delete();
    }
    public function all(array $data)
    {
        $items = $this->adModel->orderByDesc('id')->with(['user']);
        $this->filter($items,$data);
        return getCaseCollection($items,$data);
    }
}
