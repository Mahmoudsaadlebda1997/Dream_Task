<?php

namespace Modules\AdsModule\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\CountryModule\Transformers\CityResource;
use Modules\CountryModule\Transformers\CountryResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "email"=>$this->email,
            "ads_count"=>$this->ads_count,
            "active"=>$this->active,
            "created_at"=>$this->created_at,
            "updated_at"=>$this->updated_at,
            "country" => CountryResource::make($this->whenLoaded('country')),
            "city" => CityResource::make($this->whenLoaded('city')),
            "ads" => AdsResource::collection($this->whenLoaded('ads')),
        ];
    }
}
