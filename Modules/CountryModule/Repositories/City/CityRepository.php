<?php
namespace Modules\CountryModule\Repositories\City;


use Modules\CountryModule\Entities\City;

class CityRepository
{
    use CityRepoHelper;

    private $cityModel;

    public function __construct()
    {
        $this->cityModel = new City();
    }

    public function create(array $data){

        $city = $this->cityModel->create($data);

        return $city;
    }
    public function update(array $data){

        $city = $this->cityModel->find($data['id'] ?? null);

        $city->update($data);

        return $city;
    }
    public function find($id){

        return $this->cityModel->whereId($id)->with('country','users')->first();

    }
    public function findByIds($ids){
        return $this->cityModel->whereIn('id',$ids)->with('country','users')->get();
    }

    public function delete($ids){

        return $this->cityModel->whereIn('id',$ids)->delete();
    }

    public function all(array $data){
        $cities =$this->cityModel->with('country','users')->orderBy('id');
        $this->filter($cities, $data);
        return getCaseCollection($cities, $data);
    }
}
