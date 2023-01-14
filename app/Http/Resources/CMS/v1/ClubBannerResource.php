<?php

namespace App\Http\Resources\CMS\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class ClubBannerResource extends JsonResource
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
            'id'           => $this->id,
            'club'         => $this->club ? [
                'name' => $this->club->accountable->name,
            ] : null,
            'club_id'      => $this->club_id,
            'website_url'  => $this->website_url,
            'banner_image' => $this->banner_image,
        ];
    }
}
