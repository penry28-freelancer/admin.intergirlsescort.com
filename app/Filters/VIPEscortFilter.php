<?php

namespace App\Filters;

use Carbon\Carbon;

class VIPEscortFilter extends QueryFilter
{
    public function age($query)
    {
        $data   = explode(',', $query);
        $from   = $data[0] ?? 18;
        $to     = $data[1] ?? 50;
        // 18 - 20  2004 - 2002
        $nowYear = Carbon::now()->year;
        // 2022 - 18 = 2004
        // 2022 - 20 = 2002
        $fromYear   = $nowYear - $from;
        $toYear     = $nowYear - $to;

        return $this->__builder->whereBetween('birt_year', [$toYear, $fromYear]);
    }
    public function hair_color($query)
    {
        return $this->__whereSingleOrMoreQueryValue('hair_color', $query);
    }

    public function hair_length($query)
    {
        return $this->__whereSingleOrMoreQueryValue('hair_lenght', $query);
    }

    public function public_hair($query)
    {
        return $this->__whereSingleOrMoreQueryValue('hair_public', $query);
    }

    public function rates()
    {
    }

    public function breast_size($query)
    {
        return $this->__whereSingleOrMoreQueryValue('bust_size', $query);
    }

    public function breast_type($query)
    {
        return $this->__whereSingleOrMoreQueryValue('bust_type', $query);
    }

    public function height($query)
    {
        return $this->__whereSingleOrMoreQueryValue('height', $query);
    }

    public function weight($query)
    {
        return $this->__whereSingleOrMoreQueryValue('weight', $query);
    }

    public function service($serviceId)
    {
        return $this->__builder->with([
            'service', function ($query) use ($serviceId) {
                return $query->where('service_id', $serviceId);
            }
        ]);
    }

    public function nationality($query)
    {
        return $this->__whereSingleOrMoreQueryValue('nationality_counter_id', $query);
    }

    public function smoker($query = 'no')
    {
        return $this->__whereSingleOrMoreQueryValue('smoker', $query);

    }

    public function piercing($query = 'no')
    {
        return $this->__whereSingleOrMoreQueryValue('piercing', $query);
    }

    public function tattoo($query = 'no')
    {
        return $this->__whereSingleOrMoreQueryValue('tattoo', $query);
    }

}
