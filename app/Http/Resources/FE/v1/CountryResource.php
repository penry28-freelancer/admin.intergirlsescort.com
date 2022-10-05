<?php

namespace App\Http\Resources\FE\v1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'full_name' => $this->full_name,
            'flag_image' => $this->flag_image,
            'calling_code' => $this->calling_code,
            'escorts_count' => $this->escorts_count,
            'cities' => CityResource::collection($this->cities),
        ];
    }
}
