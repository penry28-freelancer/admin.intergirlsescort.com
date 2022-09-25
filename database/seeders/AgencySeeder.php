<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('agencies')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $agencies = [
            [
                'name'                 => 'Denis',
                'email'                => 'denis@gmail.com',
                'password'             => \Hash::make('12345678Ad'),
                'country_id'           => 1,
                'city_id'              => 1,
                'description'          => 'Denis',
                'website'              => 'http://booking.something.vm/',
                'calling_country_id_1' => 1,
                'phone_1'              => '12345679',
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
                'banner_url'           => null,
                'is_vetified'          => 1,
                'email_verified_at'    => Carbon::now(),
            ],
            [
                'name'                 => 'Howard',
                'email'                => 'howard@gmail.com',
                'password'             => \Hash::make('12345678Ad'),
                'country_id'           => 1,
                'city_id'              => 1,
                'description'          => 'Howard',
                'website'              => 'http://booking.something.vm/',
                'calling_country_id_1' => 1,
                'phone_1'              => '12345679',
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
                'banner_url'           => null,
                'is_vetified'          => 1,
                'email_verified_at'    => Carbon::now(),
            ],
            [
                'name'                 => 'Tobin',
                'email'                => 'tobin@gmail.com',
                'password'             => \Hash::make('12345678Ad'),
                'country_id'           => 1,
                'city_id'              => 1,
                'description'          => 'Tobin',
                'website'              => 'http://booking.something.vm/',
                'calling_country_id_1' => 1,
                'phone_1'              => '12345679',
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
                'banner_url'           => null,
                'is_vetified'          => 1,
                'email_verified_at'    => Carbon::now(),
            ],
        ];

        foreach ($agencies as $agency) {
            \DB::table('agencies')->insert([
//                'name'                 => $agency['name'],
//                'email'                => $agency['email'],
//                'password'             => $agency['password'],
                'country_id'           => $agency['country_id'],
                'city_id'              => $agency['city_id'],
                'is_vetified'          => $agency['is_vetified'],
                'email_verified_at'    => $agency['email_verified_at'],
                'description'          => $agency['description'],
                'website'              => $agency['website'],
                'calling_country_id_1' => $agency['calling_country_id_1'],
                'phone_1'              => $agency['phone_1'],
                'is_viber_1'           => $agency['is_viber_1'],
                'is_whatsapp_1'        => $agency['is_whatsapp_1'],
                'wechat_1'             => $agency['wechat_1'],
                'telegram_1'           => $agency['telegram_1'],
                'line_1'               => $agency['line_1'],
                'is_signal_1'          => $agency['is_signal_1'],
                'calling_country_id_2' => $agency['calling_country_id_2'],
                'phone_2'              => $agency['phone_2'],
                'is_viber_2'           => $agency['is_viber_2'],
                'is_whatsapp_2'        => $agency['is_whatsapp_2'],
                'wechat_2'             => $agency['wechat_2'],
                'telegram_2'           => $agency['telegram_2'],
                'line_2'               => $agency['line_2'],
                'is_signal_2'          => $agency['is_signal_2'],
                'banner_url'           => $agency['banner_url'],
//                'is_vetified'          => $agency['is_vetified'],
//                'email_verified_at'    => $agency['email_verified_at'],
                'created_at'           => Carbon::now(),
                'updated_at'           => Carbon::now(),
            ]);
        }
    }
}
