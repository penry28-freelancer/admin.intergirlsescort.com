<?php

namespace App\Http\Resources\FE\v1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClubResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->accountable->name,
            'email' => $this->accountable->email,
            'is_verified' => $this->accountable->is_verified,
            'address' => $this->address,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'escort_count' => $this->city->escorts->count(),
            'escorts' => $this->city->escorts,

            // TODO: working process later
            'verified_escort_count' => rand(0, $this->city->escorts->count()),
            'is_top' => rand(0, 1),

            'reviews_count' => $this->reviews_count,
            'reviews' => $this->reviews,
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
