<?php

namespace App\Filters;

class VideoEscortFilter extends QueryFilter
{
    public function most_popular()
    {

    }
    public function most_viewed()
    {
        return $this->__builder->orderBy('views', 'desc');
    }

    public function shemale_video()
    {
        return $this->__builder->with([
            'escort' => function($query) {
                $query->where('sex', config('constants.sex.label.3'));
            }
        ]);
    }
}
