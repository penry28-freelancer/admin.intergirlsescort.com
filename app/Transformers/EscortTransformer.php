<?php

namespace App\Transformers;

use App\Models\Escort;
use League\Fractal\TransformerAbstract;

class EscortTransformer extends TransformerAbstract
{
    /**
     * @param Escort $escort
     * @return array
     */
    public function transform(Escort $escort): array
    {
        return [
            'id' => $escort->id,
            'name' => optional($escort->account)->name,
            'email' => optional($escort->account)->email,
            'is_verified' => $escort->is_verified,
            'agency_id' => $escort->agency_id,
            'timezone' => $escort->timezone,
            'is_independent' => $escort->is_independent,
            'is_new' => $escort->is_new,
            'is_pornstar' => $escort->is_pornstar,
            'is_vip' => $escort->is_vip,
            'has_video' => $escort->has_video,
            'has_review' => $escort->has_review,
            'list_images' => $escort->list_images,
            'services' => $escort->services,
            'works' => $escort->works,
            'country' => $escort->country,
            'city' => $escort->city,
            'languages' => $escort->languages,
            'reviews' => $escort->reviews,
            'tours' => $escort->tours,
            'video_path' => $escort->video_path,
            'thumbnail' => $escort->thumbnail,
            'avatar' => optional($escort->avatarImage)->image_path,
        ];
    }
}
