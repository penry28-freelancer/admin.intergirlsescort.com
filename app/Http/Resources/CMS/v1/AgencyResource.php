<?php

namespace App\Http\Resources\CMS\v1;

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
            'country_id' => $this->country_id,
            'country' => $this->country,
            'city_id' => $this->city_id,
            'city' => $this->city,
            'description' => $this->description,
            'website' => $this->website,
            'calling_country_id_1' => $this->calling_country_id_1,
            'phone_1' => $this->phone_1,
            'is_viber_1' => $this->is_viber_1,
            'is_whatsapp_1' => $this->is_whatsapp_1,
            'wechat_1' => $this->wechat_1,
            'telegram_1' => $this->telegram_1,
            'line_1' => $this->line_1,
            'is_signal_1' => $this->is_signal_1,
            'calling_country_id_2' => $this->calling_country_id_2,
            'phone_2' => $this->phone_2,
            'is_viber_2' => $this->is_viber_2,
            'is_whatsapp_2' => $this->is_whatsapp_2,
            'wechat_2' => $this->wechat_2,
            'telegram_2' => $this->telegram_2,
            'line_2' => $this->line_2,
            'is_signal_2' => $this->is_signal_2,
            'banner_url' => $this->banner_url,
        ];
    }
}
