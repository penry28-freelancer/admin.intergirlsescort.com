<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class UniversityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'city_id' => $this->city_id,
            'city' => $this->city ? [
                'name' => $this->city->name,
            ] : null,
            'majors_count' => $this->majors->count(),
            'type' => $this->type,
            'address' => $this->address,
            'phone' => $this->phone,
            'website' => $this->website,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
