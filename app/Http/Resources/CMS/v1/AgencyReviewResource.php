<?php

namespace App\Http\Resources\CMS\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class AgencyReviewResource extends JsonResource
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
            'agency_id' => $this->agency_id,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'is_verified' => $this->is_verified,
            'agency' => [
                'id' => $this->agency->id,
                'name' => $this->agency->name,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
