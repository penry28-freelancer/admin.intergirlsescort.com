<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class SiteManagementResource extends JsonResource
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
            'brand_name' => $this->brand_name,
            'logo_image' => get_storage_image_url(optional($this->logoImage)->path, 'logo'),
            'favicon_image' => get_storage_image_url(optional($this->faviconImage)->path, 'favicon'),
            'greeting' => $this->greeting,
            'global_notification' => $this->global_notification,
            'banner_image' => get_storage_image_url(optional($this->bannerImage)->path, 'banner'),
            'top_slogan' => $this->top_slogan,
            'sub_top_slogan' => $this->sub_top_slogan,
            'maintenance_mode' => $this->maintenance_mode,
            'support_phone' => $this->support_phone,
            'support_email' => $this->support_email,
            'default_sender_email_address' => $this->default_sender_email_address,
            'default_email_sender_name' => $this->default_email_sender_name,
            'facebook_link' => $this->facebook_link,
            'facebook_fanpage_link' => $this->facebook_fanpage_link,
            'zalo_phone' => $this->zalo_phone,
            'zalo_group_link' => $this->zalo_group_link,
            'instagram_link' => $this->instagram_link,
            'youtube_link' => $this->youtube_link,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'meta_type' => $this->meta_type,
            'meta_locale' => $this->meta_locale,
            'meta_author' => $this->meta_author,
        ];
    }
}
