<?php

namespace App\Filters;

use App\Traits\HasLocationFilter;
use App\Traits\HasSearchable;

class BlacklistClientFilter extends QueryFilter
{
    use HasLocationFilter, HasSearchable;
}
