<?php

namespace App\Http\Resources\CMS\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class AffilateResource extends JsonResource
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
            'name' => $this->accountable->name,
            'email' => $this->accountable->email,
            'is_verified' => $this->accountable->is_verified,
            'country' => $this->country,
            'city' => $this->city,
        ];
    }
}
