<?php

namespace App\Filters;

use App\Traits\HasLocationFilter;
use App\Traits\HasSearchable;

class BlackListAgencyFilter extends QueryFilter
{
    use HasLocationFilter, HasSearchable;
}
