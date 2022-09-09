<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AccountAgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('account_agencies')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $account_agencies = [
            [
                'name'                 => 'Denis',
                'email'                => 'denis@gmail.com',
                'country_id'           => 1,
                'city_id'              => 1,
                'password'             => \Hash::make('12345678Ad'),
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
                'country_id'           => 1,
                'city_id'              => 1,
                'password'             => \Hash::make('12345678Ad'),
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
                'country_id'           => 1,
                'city_id'              => 1,
                'password'             => \Hash::make('12345678Ad'),
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

        foreach ($account_agencies as $account_agency) {
            \DB::table('account_agencies')->insert([
                'name'                 => $account_agency['name'],
                'email'                => $account_agency['email'],
                'country_id'           => $account_agency['country_id'],
                'city_id'              => $account_agency['city_id'],
                'password'             => $account_agency['password'],
                'is_vetified'          => $account_agency['is_vetified'],
                'email_verified_at'    => $account_agency['email_verified_at'],
                'description'          => $account_agency['description'],
                'website'              => $account_agency['website'],
                'calling_country_id_1' => $account_agency['calling_country_id_1'],
                'phone_1'              => $account_agency['phone_1'],
                'is_viber_1'           => $account_agency['is_viber_1'],
                'is_whatsapp_1'        => $account_agency['is_whatsapp_1'],
                'wechat_1'             => $account_agency['wechat_1'],
                'telegram_1'           => $account_agency['telegram_1'],
                'line_1'               => $account_agency['line_1'],
                'is_signal_1'          => $account_agency['is_signal_1'],
                'calling_country_id_2' => $account_agency['calling_country_id_2'],
                'phone_2'              => $account_agency['phone_2'],
                'is_viber_2'           => $account_agency['is_viber_2'],
                'is_whatsapp_2'        => $account_agency['is_whatsapp_2'],
                'wechat_2'             => $account_agency['wechat_2'],
                'telegram_2'           => $account_agency['telegram_2'],
                'line_2'               => $account_agency['line_2'],
                'line_2'               => $account_agency['line_2'],
                'is_signal_2'          => $account_agency['is_signal_2'],
                'banner_url'           => $account_agency['banner_url'],
                'is_vetified'          => $account_agency['is_vetified'],
                'email_verified_at'    => $account_agency['email_verified_at'],
                'created_at'           => Carbon::now(),
                'updated_at'           => Carbon::now(),
            ]);
        }
    }
}
