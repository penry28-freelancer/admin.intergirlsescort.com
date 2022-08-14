<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'sex' => $this->sex,
            'email' => $this->email,
            'phone' => $this->phone,
            'is_active' => $this->is_active,
            'is_draft' => $this->is_draft,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
