<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'escort_id' => random_int(1, 100),
            'account_id' => null,
            'path' => $this->faker->url(),
            'views' => random_int(0, 10000),
            'type' => 'mp4',
            'duration' => random_int(10, 100),
        ];
    }
}
