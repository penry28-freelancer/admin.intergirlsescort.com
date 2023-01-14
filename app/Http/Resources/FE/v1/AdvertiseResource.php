<?php

namespace App\Http\Resources\FE\v1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertiseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|\JsonSerializable
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
        ];
    }
}
