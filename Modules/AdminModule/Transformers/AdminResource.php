<?php

namespace Modules\AdminModule\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            'email' => $this->email,
            'privileges' => $this->privileges,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
