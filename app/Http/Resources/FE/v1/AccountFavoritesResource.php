<?php

namespace App\Http\Resources\FE\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountFavoritesResource extends JsonResource
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
            'favorites' => collect($this->favorites)->map(function($account) {
                return [
                    'id' => $account->id,
                    'name' => $account->name,
                    'gold' => $account->gold,
                    'email' => $account->email,
                    'is_verified' => $account->is_verified,
                    'transactions_count' => $account->transactions_count,
                    'avatar_image' => get_storage_image_url(optional($this->avatarImage)->path),
                    'profile' => $account->profile(),
                ];
            }),
        ];
    }
}
