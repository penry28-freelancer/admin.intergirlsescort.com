<?php

namespace App\Http\Resources\FE\v1;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EscortResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->load('videoInfo');
        return [
            'id'                     => $this->id,
            'name'                   => $this->accountable->name,
            'email'                  => $this->accountable->email,
            'is_verified'            => $this->accountable->is_verified,
            'agency_id'              => $this->agency_id,
            'country_id'             => $this->country_id,
            'city_id'                => $this->city_id,
            'perex'                  => $this->perex,
            'sex'                    => $this->sex,
            'birt_year'              => $this->birt_year,
            'height'                 => $this->height,
            'weight'                 => $this->weight,
            'ethnicity'              => $this->ethnicity,
            'hair_color'             => $this->hair_color,
            'hair_lenght'            => $this->hair_lenght,
            'bust_size'              => $this->bust_size,
            'bust_type'              => $this->bust_type,
            'dick_size'              => $this->dick_size,
            'provides1'              => $this->provides1,
            'nationality_counter_id' => $this->nationality_counter_id,
            'travel'                 => $this->travel,
            'tattoo'                 => $this->tattoo,
            'piercing'               => $this->piercing,
            'smoker'                 => $this->smoker,
            'eye'                    => $this->eye,
            'orientation'            => $this->orientation,
            'hair_pubic'             => $this->hair_pubic,
            'pornstar'               => $this->pornstar,
            'verify_text'            => $this->verify_text,
            'provides'               => $this->provides,
            'meeting_with'           => $this->meeting_with,
            'website'                => $this->website,
            'phone1_code'            => $this->phone1_code,
            'phone1'                 => $this->phone1,
            'phone1_viber'           => $this->phone1_viber,
            'phone1_whatsapp'        => $this->phone1_whatsapp,
            'phone1_wechat'          => $this->phone1_wechat,
            'phone1_telegram'        => $this->phone1_telegram,
            'phone1_lineapp'         => $this->phone1_lineapp,
            'phone1_signal'          => $this->phone1_signal,
            'phone1_wechatid'        => $this->phone1_wechatid,
            'phone1_lineappid'       => $this->phone1_lineappid,
            'phone1_telegramid'      => $this->phone1_telegramid,
            'phone2_code'            => $this->phone2_code,
            'phone2'                 => $this->phone2,
            'phone2_viber'           => $this->phone2_viber,
            'phone2_whatsapp'        => $this->phone2_whatsapp,
            'phone2_wechat'          => $this->phone2_wechat,
            'phone2_telegram'        => $this->phone2_telegram,
            'phone2_lineapp'         => $this->phone2_lineapp,
            'phone2_signal'          => $this->phone2_signal,
            'phone2_wechatid'        => $this->phone2_wechatid,
            'phone2_lineappid'       => $this->phone2_lineappid,
            'phone2_telegramid'      => $this->phone2_telegramid,
            'video'                  => $this->videoInfo,
            'counter_currency_id'    => $this->counter_currency_id,
            'rate_incall_30'         => $this->rate_incall_30,
            'rate_outvall_30'        => $this->rate_outvall_30,
            'rate_incall_1'          => $this->rate_incall_1,
            'rate_outvall_1'         => $this->rate_outvall_1,
            'rate_incall_2'          => $this->rate_incall_2,
            'rate_outvall_2'         => $this->rate_outvall_2,
            'rate_incall_3'          => $this->rate_incall_3,
            'rate_outvall_3'         => $this->rate_outvall_3,
            'rate_incall_6'          => $this->rate_incall_6,
            'rate_outvall_6'         => $this->rate_outvall_6,
            'rate_incall_12'         => $this->rate_incall_12,
            'rate_outvall_12'        => $this->rate_outvall_12,
            'rate_incall_24'         => $this->rate_incall_24,
            'rate_outvall_24'        => $this->rate_outvall_24,
            'rate_incall_48'         => $this->rate_incall_48,
            'rate_outvall_48'        => $this->rate_outvall_48,
            'rate_incall_24_second'  => $this->rate_incall_24_second,
            'rate_outvall_24_second' => $this->rate_outvall_24_second,
            'timezone'               => $this->timezone,
            'created_at'             => $this->created_at,
            'updated_at'             => $this->updated_at,
            'list_images'            => $this->images ? collect($this->images)->map(function($image) {
                return [
                    'id' => $image->id,
                    'path' => $image->path,
                    'image_path' => getImagePath($image->path),
                ];
            }) : [],
            'services'               => $this->services ? collect($this->services)->map(function($service) {
                return [
                    'id'          => $service->id,
                    'name'        => $service->name,
                    'escort_id'   => $service->pivot->escort_id,
                    'service_id'  => $service->pivot->service_id,
                    'is_included' => $service->pivot->is_included,
                    'extra_price' => $service->pivot->extra_price,
                ];
            }) : null,
            'working_time'           => $this->works ? collect($this->works)->map(function($time) {
                return [
                    'id'        => $time->id,
                    'name'      => $time->name,
                    'order'     => $time->order,
                    'escort_id' => $time->pivot->escort_id,
                    'day_id'    => $time->pivot->day_id,
                    'from'      => formatDatetime($time->pivot->from, 'h:i'),
                    'to'        => formatDatetime($time->pivot->to, 'h:i'),
                    'all_day'   => $time->pivot->all_day ? 1 : 0,
                ];
            }) : null,
            'account'                => $this->accountable,
            'is_independent'         => $this->is_independent,
            'is_new'                 => $this->is_new,
            'is_pornstar'            => $this->is_pornstar,
            'is_vip'                 => $this->is_vip,
            'has_video'              => $this->has_video,
            'has_review'             => $this->has_review,
            'country'                => $this->country,
            'city'                   => $this->city,
            'languages'              => collect($this->languages)->map(function($language) {
                return [
                    'id'   => $language->id,
                    'name' => $language->name,
                ];
            }),
            'belongEscort'           => $this->belongEscort,
            'reviews'                => collect($this->reviews)->map(function($review) {
                return [
                    'id'               => $review->id,
                    'nickname'         => $review->nickname,
                    'country_id'       => $review->country_id,
                    'country'          => $review->country ? [
                        'id'           => $review->country->id,
                        'name'         => $review->country->name,
                        'slug'         => $review->country->slug,
                        'full_name'    => $review->country->full_name,
                        'calling_code' => $review->country->calling_code,
                        'flag_image'   => $review->country->flag_image,
                    ] : null,
                    'city_id' => $review->city_id,
                    'city'           => $review->city,
                    'escort_id'      => $review->escort_id,
                    'meeting_date'   => $review->meeting_date,
                    'meeting_length' => $review->meeting_length,
                    'price'          => $review->price,
                    'currency_id'    => $review->currency_id,
                    'rating'         => $review->rating,
                    'comment'        => $review->comment,
                    'is_verified'    => $review->is_verified,
                ];
            }),
            'tours'           => $this->tours,
            'video_path'      => $this->videoInfo ? get_storage_file_url($this->videoInfo->path) : null,
            'thumbnail'       => get_storage_file_url(optional($this->videoInfo)->thumbnail),
            'avatar'          => $this->avatarImage,
            'block_countries' => $this->blockCountries,
            'second_escort'   => new EscortResource($this->escort),
        ];
    }
}
