<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{

    public function configure()
    {
        return $this->afterCreating(function (Member $member) {
            $account = $member->accountable()->create([
                'name' => $this->faker->name(),
                'email' => $this->faker->email(),
                'password' => \Hash::make('123456789')
            ]);

            $escort_ids = \DB::table('accounts')->where('accountable_type', '=', 'App\Models\Escort')->inRandomOrder()->limit(4)->pluck('id')->toArray();
            $agency_ids = \DB::table('accounts')->where('accountable_type', '=', 'App\Models\Agency')->inRandomOrder()->limit(4)->pluck('id')->toArray();
            $club_ids   = \DB::table('accounts')->where('accountable_type', '=', 'App\Models\Club')->inRandomOrder()->limit(4)->pluck('id')->toArray();

            $account->favorites()->sync($escort_ids);
            $account->favorites()->sync($agency_ids);
            $account->favorites()->sync($club_ids);
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
