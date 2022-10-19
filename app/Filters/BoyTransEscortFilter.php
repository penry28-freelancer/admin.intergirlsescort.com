<?php

namespace App\Filters;

use App\Traits\HasLocationFilter;

class BoyTransEscortFilter extends NormalFilter
{
    use HasLocationFilter;

    public function sex($query)
    {
        return $this->__whereSingleOrMoreQueryValue('sex', $query);
    }
}
