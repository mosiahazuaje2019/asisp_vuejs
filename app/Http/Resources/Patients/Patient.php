<?php

namespace App\Http\Resources\Patients;

use Illuminate\Http\Resources\Json\JsonResource;

class Patient extends JsonResource
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
            'id'             => $this->id,
            'first_name'     => $this->first_name,
            'last_name'      => $this->last_name,
            'identification' => $this->identification,
            'phone'          => $this->phone,
            'email'          => $this->email,
            'sex'            => $this->sex,
            'city_id'        => $this->city_id,
            'birthday'       => $this->birthday,
            'address'        => $this->address,
            'created_at'     => $this->created_at->format('d/m/Y')
        ];
    }
}
