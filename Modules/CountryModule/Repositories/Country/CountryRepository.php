<?php
namespace Modules\CountryModule\Repositories\Country;


use Modules\CountryModule\Entities\Country;

class CountryRepository
{
    use CountryRepoHelper;

    private $countryModel;

    public function __construct()
    {
        $this->countryModel = new Country();
    }

    public function create(array $data){

        $country = $this->countryModel->create($data);

        return $country;
    }
    public function update(array $data){

        $country = $this->countryModel->find($data['id'] ?? null);

        $country->update($data);

        return $country;
    }
    public function find($id){

        return $this->countryModel->whereId($id)->with('cities')->first();

    }
    public function findByIds($ids){
        return $this->countryModel->whereIn('id',$ids)->with('cities')->get();
    }

    public function delete($ids){

        return $this->countryModel->whereIn('id',$ids)->delete();
    }

    public function all(array $data){
        $countries =$this->countryModel->with('cities')->orderBy('id');
        $this->filter($countries, $data);
        return getCaseCollection($countries, $data);
    }
}
