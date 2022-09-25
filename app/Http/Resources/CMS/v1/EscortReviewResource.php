<?php

namespace App\Http\Resources\CMS\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class EscortReviewResource extends JsonResource
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
            'nickname' => $this->nickname,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'escort_id' => $this->escort_id,
            'meeting_date' => $this->meeting_date,
            'meeting_length' => $this->meeting_length,
            'price' => $this->price,
            'currency_id' => $this->currency_id,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'is_verified' => $this->is_verified,
            'escort' => [
                'id' => $this->escort->id,
                'name' => $this->escort->name,
            ],
            'country' => [
                'id' => $this->country->id,
                'name' => $this->country->name,
            ],
            'city' => [
                'id' => $this->city->id,
                'name' => $this->city->name,
            ],
            'currency' => [
                'id' => $this->currency->id,
                'name' => $this->currency->name,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
