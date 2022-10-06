<?php

namespace App\Filters;

use App\Traits\HasLocationFilter;

class ReviewEscortFilter extends QueryFilter
{
    use HasLocationFilter;

    public function rating($star)
    {
        return $this->__whereSingleOrMoreQueryValue('rating', $star);
    }
}
