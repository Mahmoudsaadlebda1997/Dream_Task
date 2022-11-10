<?php

namespace Modules\CountryModule\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AdminModule\Transformers\AdminResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'cities' => CityResource::collection($this->whenLoaded('cities')),
        ];
    }
}
