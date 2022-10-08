<?php

namespace App\Http\Resources\FE\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthResource extends JsonResource
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
            'id'    => $this->id,
            'email' => $this->email,
            'name'  => $this->name,
            'gold'  => $this->gold,
            'type'  => $this->type,
            'detail' => $this->profile()
        ];
    }
}
