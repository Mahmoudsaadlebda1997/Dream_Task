<?php

namespace Modules\AdsModule\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AdsResource extends JsonResource
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
            "ad_image_path"=>$this->ad_image_path,
            "title"=>$this->title,
            "start_date"=>$this->start_date,
            "end_date"=>$this->end_date,
            "active"=>$this->active,
            "created_at"=>$this->created_at,
            "updated_at"=>$this->updated_at,
            "user" => UsersResource::make($this->whenLoaded('user')),
        ];
    }
}
