<?php

namespace Database\Factories;

use App\Models\Club;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClubReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nickname' => $this->faker->name,
            'club_id' => Club::inRandomOrder()->first()->id,
            'rating' => rand(0, 5),
            'comment' => $this->faker->sentence,
            'is_verified' => rand(0, 1),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
