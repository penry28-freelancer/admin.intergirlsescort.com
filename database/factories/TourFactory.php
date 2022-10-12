<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $subStartDate = random_int(1, 100);
        $subEndDate = $subStartDate - random_int(1, 10);

        $startDate = Carbon::now()->subDay($subStartDate);
        $endDate = Carbon::now()->subDay($subEndDate);

        return [
            'title' => $this->faker->title(),
            'agency_id' => 1,
            'escort_id' => 1,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'country_id' => random_int(1, DB::table('countries')->count()),
            'city_id' => random_int(1, DB::table('cities')->count()),
        ];
    }
}
