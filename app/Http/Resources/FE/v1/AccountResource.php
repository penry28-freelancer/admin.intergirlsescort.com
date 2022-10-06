<?php

namespace App\Http\Resources\FE\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email, 
            'gold' => $this->gold, 
            'accountable_id' => $this->accountable_id,
            'accountable_type' => $this->accountable_type,
            'is_verified' => $this->is_verified,
            'email_verified_at' => $this->email_verified_at
        ];
    }
}
