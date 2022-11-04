<?php

namespace App\Http\Resources\FE\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class AgencyResource extends JsonResource
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
            'name' => $this->accountable->name,
            'email' => $this->accountable->email,
            'is_verified' => $this->accountable->is_verified,
            'has_review' => $this->accountable->has_review,
            'is_new' => $this->accountable->is_new,
            'is_vip' => $this->accountable->is_vip,

            'escorts_count' => $this->escorts ? optional($this->escorts)->count() : 0,
            'escorts_verified_count' => $this->escorts ? optional($this->escorts)->count() : 0,
            'accountable' => $this->accountable,

            'country_id' => $this->country_id,
            'country' => $this->country,
            'city_id' => $this->city_id,
            'city' => $this->city,
            'description' => $this->description,
            'website' => $this->website,
            'avatar' => $this->accountable->avatar,

            'calling_country_id_1' => $this->calling_country_id_1,
            'phone_1' => $this->phone_1,
            'phone1_viber' => $this->phone1_viber,
            'phone1_whatsapp' => $this->phone1_whatsapp,
            'phone1_wechat' => $this->phone1_wechat,
            'phone1_telegram' => $this->phone1_telegram,
            'phone1_lineapp' => $this->phone1_lineapp,
            'phone1_signal' => $this->phone1_signal,
            'phone1_wechatid' => $this->phone1_wechatid,
            'phone1_lineappid' => $this->phone1_lineappid,
            'phone1_telegramid' => $this->phone1_telegramid,
            'calling_country_id_2' => $this->calling_country_id_2,
            'phone_2' => $this->phone_2,
            'phone2_viber' => $this->phone2_viber,
            'phone2_whatsapp' => $this->phone2_whatsapp,
            'phone2_wechat' => $this->phone2_wechat,
            'phone2_telegram' => $this->phone2_telegram,
            'phone2_lineapp' => $this->phone2_lineapp,
            'phone2_signal' => $this->phone2_signal,
            'phone2_wechatid' => $this->phone2_wechatid,
            'phone2_lineappid' => $this->phone2_lineappid,
            'phone2_telegramid' => $this->phone2_telegramid,

            'banner_url' => $this->banner_url,
            'banner_image' => $this->accountable->bannerImage ? [
                'path' => get_storage_image_url(optional($this->accountable->bannerImage)->path),
                'name' => $this->accountable->bannerImage->name,
            ] : null,
            'escorts' => $this->escortsWithAccount,
            'reviews' => $this->reviews
        ];
    }
}
