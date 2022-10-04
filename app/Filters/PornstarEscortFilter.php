<?php

namespace App\Filters;

class PornstarEscortFilter extends VIPEscortFilter
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
