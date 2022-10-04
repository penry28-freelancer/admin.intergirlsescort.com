<?php

namespace App\Filters;

use App\Models\Escort;
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

    public function review()
    {
        return $this->__builder->whereHas('reviews');
    }

    public function verified()
    {
        return $this->__builder->whereHas('accountable', function($query) {
            $query->where('is_verified', config('constants.verified.true'));
        });
    }

    public function newcomer()
    {
        return $this->__builder->whereDate('created_at', '>=', Carbon::now()->subDays(Escort::LIMIT_NEW_COMER_DAY));
    }

    public function video()
    {
        return $this->__builder->whereHas('videoInfo');
    }

    public function pornstar()
    {
        return $this->__builder->where('pornstar', config('constants.pornstar.yes'));
    }

    public function independent()
    {
        return $this->__builder->whereNull('agency_id');
    }

    public function douwithgirl()
    {
        return $this->__builder
            ->whereNotNull('belong_escort_id')
            ->where('sex', config('constants.sex.label.5'));
    }

    public function couple()
    {
        return $this->__builder
            ->whereNotNull('belong_escort_id')
            ->where('sex', config('constants.sex.label.4'));
    }
}
