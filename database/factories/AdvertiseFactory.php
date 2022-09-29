<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdvertiseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'link1' => $this->faker->url,
            'link2' => $this->faker->url,
            'link3' => $this->faker->url,
            'order' => $this->faker->numberBetween(1, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
