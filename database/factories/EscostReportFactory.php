<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class EscostReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nick_name' => $this->faker->name(),
            'name_of_escost' => $this->faker->name('female'),
            'country_id' => random_int(1, DB::table('countries')->count()),
            'city_id' => random_int(1, DB::table('cities')->count()),
            'date_added' => Carbon::now(),
            'calling_country_id' => 1,
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'description' => $this->faker->paragraph(),
            'verified_at' => Carbon::now(),
        ];
    }
}
