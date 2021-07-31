<?php

namespace App\Http\Resources\Cities;

use Illuminate\Http\Resources\Json\JsonResource;

class City extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->region,
            'department' => $this->department,
            'city'       => $this->city,
        ];
    }
}
