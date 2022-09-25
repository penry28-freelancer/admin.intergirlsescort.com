<?php

namespace App\Http\Resources\CMS\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertiseResource extends JsonResource
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
            'link1' => $this->link1,
            'link2' => $this->link2,
            'link3' => $this->link3,
            'order' => $this->order,
            'banner_image' => get_storage_image_url(optional($this->bannerImage)->path),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
