<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AccountClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('account_clubs')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $account_clubs = [
            [
                'name'                 => 'Denis',
                'email'                => 'denis@gmail.com',
                'address'              => 'Berlin',
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
                'club_hours'           => ['18:00 - 3:00'],
            ],
            [
                'name'                 => 'Howard',
                'email'                => 'howard@gmail.com',
                'address'              => 'London',
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
                'club_hours'           => ['18:00 - 3:00'],
            ],
            [
                'name'                 => 'Tobin',
                'email'                => 'tobin@gmail.com',
                'address'              => 'Paris',
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
                'club_hours'           => ['18:00 - 3:00'],
            ],
        ];

        foreach ($account_clubs as $account_club) {
            $club_id = \DB::table('account_clubs')->insertGetId([
                'name'                 => $account_club['name'],
                'email'                => $account_club['email'],
                'address'              => $account_club['address'],
                'country_id'           => $account_club['country_id'],
                'city_id'              => $account_club['city_id'],
                'password'             => $account_club['password'],
                'is_vetified'          => $account_club['is_vetified'],
                'email_verified_at'    => $account_club['email_verified_at'],
                'description'          => $account_club['description'],
                'website'              => $account_club['website'],
                'calling_country_id_1' => $account_club['calling_country_id_1'],
                'phone_1'              => $account_club['phone_1'],
                'is_viber_1'           => $account_club['is_viber_1'],
                'is_whatsapp_1'        => $account_club['is_whatsapp_1'],
                'wechat_1'             => $account_club['wechat_1'],
                'telegram_1'           => $account_club['telegram_1'],
                'line_1'               => $account_club['line_1'],
                'is_signal_1'          => $account_club['is_signal_1'],
                'calling_country_id_2' => $account_club['calling_country_id_2'],
                'phone_2'              => $account_club['phone_2'],
                'is_viber_2'           => $account_club['is_viber_2'],
                'is_whatsapp_2'        => $account_club['is_whatsapp_2'],
                'wechat_2'             => $account_club['wechat_2'],
                'telegram_2'           => $account_club['telegram_2'],
                'line_2'               => $account_club['line_2'],
                'line_2'               => $account_club['line_2'],
                'is_signal_2'          => $account_club['is_signal_2'],
                'banner_url'           => $account_club['banner_url'],
                'is_vetified'          => $account_club['is_vetified'],
                'email_verified_at'    => $account_club['email_verified_at'],
                'created_at'           => Carbon::now(),
                'updated_at'           => Carbon::now(),
            ]);

            foreach ($account_club['club_hours'] as $club_hour) {
                \DB::table('account_club_hours')->insert([
                    'title'           => $club_hour,
                    'account_club_id' => $club_id,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ]);
            }
        }
    }
}
