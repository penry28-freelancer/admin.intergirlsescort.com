<?php

namespace App\Filters;

use App\Traits\HasLocationFilter;
use App\Traits\HasSearchable;

class BlacklistEscortFilter extends QueryFilter
{
    use HasLocationFilter, HasSearchable;
}
