<?php

namespace Database\Factories;

use App\Models\Club;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClubFactory extends Factory
{
    public function configure()
    {
        return $this->afterCreating(function (Club $club) {
            $club->clubHours()->create([
                'title' => '18:00 - 3:00'
            ]);

            $account = $club->accountable()->create([
                'name'      => $this->faker->name(),
                'email'     => $this->faker->email(),
                'password'  => \Hash::make('Club@2022')
            ]); 

            $account->images()->create([
                'name' => 'Club Avatar',
                'type' => 'avatar',
                'path' => $this->faker->imageUrl(
                    config('image.sizes.default.w'),
                    config('image.sizes.default.h'),
                ),
                'extension' => 'png',
                'featured' => 1,
                'size' => random_int(100, 2000)
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
            'address'              => $this->faker->address(),
            'country_id'           => random_int(1, 100),
            'city_id'              => random_int(1, 1000),
            'description'          => $this->faker->paragraph(),
            'website'              => $this->faker->url(),
            'calling_country_id_1' => 1,
            'phone_1'              => $this->faker->phoneNumber(),
            'is_viber_1'           => 0,
            'is_whatsapp_1'        => 1,
            'wechat_1'             => 'https://www.wechat.com/',
            'telegram_1'           => null,
            'line_1'               => null,
            'is_signal_1'          => 0,
            'calling_country_id_2' => null,
            'phone_2'              => null,
            'is_viber_2'           => 0,
            'is_whatsapp_2'        => 0,
            'wechat_2'             => null,
            'telegram_2'           => null,
            'line_2'               => null,
            'is_signal_2'          => 0,
            'banner_url'           => null
        ];
    }
}
