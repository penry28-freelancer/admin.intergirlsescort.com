<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class EscortReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $escort_ids = DB::table('escorts')->pluck('id')->toArray();
        $country_ids = DB::table('countries')->pluck('id')->toArray();
        $city_ids = DB::table('cities')->pluck('id')->toArray();
        $currency_ids = DB::table('currencies')->pluck('id')->toArray();

        return [
            'nickname' => $this->faker->name(),
            'country_id' => $country_ids[array_rand($country_ids)],
            'city_id' => $city_ids[array_rand($city_ids)],
            'escort_id' => $escort_ids[array_rand($escort_ids)],
            'meeting_date' => Carbon::now(),
            'meeting_length' => 'Metting length',
            'price' => random_int(100, 100000),
            'currency_id' => $currency_ids[array_rand($currency_ids)],
            'rating' => random_int(1, 5),
            'comment' => $this->faker->paragraph(),
            'is_verified' => random_int(0, 1),
        ];
    }
}
