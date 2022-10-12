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
        return [
            'nickname' => $this->faker->name(),
            'country_id' => random_int(1, DB::table('countries')->count()),
            'city_id' => random_int(1, DB::table('cities')->count()),
            'escort_id' => 1,
            'meeting_date' => Carbon::now(),
            'meeting_length' => 'Metting length',
            'price' => random_int(1000, 10000),
            'currency_id' => 1,
            'rating' => random_int(1, 5),
            'comment' => $this->faker->paragraph(),
            'is_verified' => random_int(0, 1),
        ];
    }
}
