<?php

namespace App\Traits;

trait HasLocationFilter
{
    public function country($query)
    {
        return $this->__whereSingleOrMoreQueryValue('country_id', $query);
    }

    public function city($query)
    {
        return $this->__whereSingleOrMoreQueryValue('city_id', $query);
    }
}
