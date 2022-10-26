<?php

namespace Database\Factories;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AgencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function configure()
    {
        return $this->afterCreating(function (Agency $agency) {
            $account = $agency->accountable()->create([
                'name'        => $this->faker->name(),
                'email'       => $this->faker->email(),
                'is_verified' => 1,
                'password'    => Hash::make('Agency@2022')
            ]);

            $account->images()->create([
                'name' => 'Agency avatar',
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

    public function definition()
    {
        $countries_ids = \DB::table('countries')->pluck('id')->toArray();
        $country_id    = $countries_ids[array_rand($countries_ids)];
        $cities_ids    = \DB::table('cities')->where('country_id', $country_id)->pluck('id')->toArray();
        $city_id       = !empty($cities_ids) ? $cities_ids[array_rand($cities_ids)] : null;

        return [
            'country_id'           => $country_id,
            'city_id'              => $city_id,
            'description'          => $this->faker->name(),
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
