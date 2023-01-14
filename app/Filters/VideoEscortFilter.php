<?php

namespace App\Filters;

class VideoEscortFilter extends QueryFilter
{
    public function most_popular()
    {
        return $this->__builder;
    }

    public function most_viewed()
    {
        return $this->__builder->orderBy('views', 'desc');
    }

    public function shemale($arg = null)
    {
        return $this->__builder->whereHas('escort', function($query) {
            $query->where('sex', config('constants.sex.label.3'));
        });
    }

    public function pornstar()
    {
        return $this->__builder->whereHas('escort', function($query) {
            $query->where('pornstar', config('constants.pornstar.yes'));
        });
    }
}
