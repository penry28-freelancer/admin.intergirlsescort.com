<?php

namespace Database\Factories;

use App\Models\Club;
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
                'name'        => $this->faker->name(),
                'email'       => $this->faker->email(),
                'is_verified' => 1,
                'password'    => \Hash::make('Club@2022')
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
            'phone1_viber'         => 0,
            'phone1_whatsapp'      => 0,
            'phone1_wechat'        => 0,
            'phone1_telegram'      => 0,
            'phone1_lineapp'       => 0,
            'phone1_signal'        => 0,
            'phone1_wechatid'      => NULL,
            'phone1_lineappid'     => NULL,
            'phone1_telegramid'    => NULL,

            'calling_country_id_2' => null,
            'phone_2'              => null,
            'phone2_viber'         => 1,
            'phone2_whatsapp'      => 1,
            'phone2_wechat'        => 1,
            'phone2_telegram'      => 1,
            'phone2_lineapp'       => 1,
            'phone2_signal'        => 1,
            'phone2_wechatid'      => '1234567',
            'phone2_lineappid'     => '1234567',
            'phone2_telegramid'    => '1234567',
            'banner_url'           => null
        ];
    }
}
