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
                'name'      => $this->faker->name(),
                'email'     => $this->faker->email(),
                'password'  => Hash::make('Agency@2022')
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
