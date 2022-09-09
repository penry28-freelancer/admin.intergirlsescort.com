<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AccountMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('account_members')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $account_members = [
            [
                'name'              => 'Denis',
                'email'             => 'denis@gmail.com',
                'country_id'        => 1,
                'city_id'           => 1,
                'password'          => \Hash::make('12345678Ad'),
                'is_vetified'       => 1,
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name'              => 'Howard',
                'email'             => 'howard@gmail.com',
                'country_id'        => 1,
                'city_id'           => 1,
                'password'          => \Hash::make('12345678Ad'),
                'is_vetified'       => 1,
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name'              => 'Tobin',
                'email'             => 'tobin@gmail.com',
                'country_id'        => 1,
                'city_id'           => 1,
                'password'          => \Hash::make('12345678Ad'),
                'is_vetified'       => 1,
                'email_verified_at' => Carbon::now(),
            ],
        ];

        foreach ($account_members as $account_member) {
            \DB::table('account_members')->insert([
                'name'              => $account_member['name'],
                'email'             => $account_member['email'],
                'country_id'        => $account_member['country_id'],
                'city_id'           => $account_member['city_id'],
                'password'          => $account_member['password'],
                'is_vetified'       => $account_member['is_vetified'],
                'email_verified_at' => $account_member['email_verified_at'],
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);
        }
    }
}
