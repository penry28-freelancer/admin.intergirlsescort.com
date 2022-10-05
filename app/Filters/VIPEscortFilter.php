<?php

namespace App\Filters;

use App\Models\Escort;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class VIPEscortFilter extends QueryFilter
{
    public function age($query)
    {
        $ages = explode(',', $query);
        if (count($ages) > 1) {
            foreach ($ages as $age) {
                [$fromYear, $toYear] = $this->__getAgeBetweenSeperator($age);

                $this->__builder = $this->__builder->orWhere(function ($query) use ($fromYear, $toYear) {
                    $query->where('birt_year', '>=', min([$fromYear, $toYear]))
                        ->where('birt_year', '<=', max([$fromYear, $toYear]));
                });
            }
            return $this->__builder;
        } else {
            [$fromYear, $toYear] = $this->__getAgeBetweenSeperator($query);

            return $this->__builder->whereBetween('birt_year', [
                min([$fromYear, $toYear]),
                max([$fromYear, $toYear]),
            ]);
        }
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

    public function rates($rates)
    {
        // ?rates[rate_1]=80-100,200-300
        // where (rate_1 >= 80 and rate_1 <= 100) or (rate_1 >= 200 and rate_1 <= 300)

        return $this->__builder->where(function($query) use ($rates) {
            
            foreach ($rates as $rate => $values) {
                $rate_values = explode(',', $values); 

                foreach($rate_values as $ranges) { 
                    $query->orWhere(function($subquery) use ($rate, $ranges) {
                        [$from, $to] = $this->__getRateBetweenSeperator($ranges);

                        $subquery->where($rate, '>=', min([$from, $to]))
                            ->where($rate, '<=', max([$from, $to]));
                    });
                }
            } 
        });  
    }

    public function breast_size($query)
    {
        return $this->__whereSingleOrMoreQueryValue('bust_size', $query);
    }

    public function breast_type($query)
    {
        return $this->__whereSingleOrMoreQueryValue('bust_type', $query);
    }

    public function travel($query)
    {
        return $this->__whereSingleOrMoreQueryValue('travel', $query);
    }

    public function height($query)
    {
        return $this->__whereSingleOrMoreQueryValue('height', $query);
    }

    public function weight($query)
    {
        return $this->__whereSingleOrMoreQueryValue('weight', $query);
    }

    public function services($serviceId)
    {
        $services = explode(',', $serviceId);

        return $this->__builder->whereHas('escort_service', function ($query) use ($services) {
            return $query->whereIn('escort_service.service_id', Arr::wrap($services));
        });
    }

    public function nationality($query)
    {
        return $this->__builder->__whereSingleOrMoreQueryValue('nationality_counter_id', $query);
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
        return $this->__builder->whereHas('accountable', function ($query) {
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

    protected function __getAgeBetweenSeperator($ageWithSeperator, $seperator = '-')
    {
        $data   = explode($seperator, $ageWithSeperator);
        $from   = $data[0] ?? 18;
        $to     = $data[1] ?? 50;
        // 18 - 20  2004 - 2002
        $nowYear = Carbon::now()->year;
        // 2022 - 18 = 2004
        // 2022 - 20 = 2002
        $fromYear   = $nowYear - $from;
        $toYear     = $nowYear - $to;

        return [
            $fromYear,
            $toYear
        ];
    }

    protected function __getRateBetweenSeperator($rateWithSeperator, $seperator = '-')
    {
        $data   = explode($seperator, $rateWithSeperator);

        $from   = $data[0] ?? config('constant.rate.min');
        $to     = $data[1] ?? config('constant.rate.max');
       
        return [
            $from,
            $to
        ];
    }
}
