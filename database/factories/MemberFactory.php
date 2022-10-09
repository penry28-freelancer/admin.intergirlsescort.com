<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{

    public function configure()
    {
        return $this->afterCreating(function (Member $member) {
            $member->accountable()->create([
                'name' => $this->faker->name(),
                'email' => $this->faker->email(),
                'password' => \Hash::make('Member@2022')
            ]);
        });
    }
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country_id'        => random_int(1, 100),
            'city_id'           => random_int(1, 1000),
        ];
    }
}
