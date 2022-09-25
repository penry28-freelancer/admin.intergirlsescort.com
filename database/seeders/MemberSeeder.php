<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('members')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $members = [
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

        foreach ($members as $member) {
            \DB::table('members')->insert([
//                'name'              => $member['name'],
//                'email'             => $member['email'],
                'country_id'        => $member['country_id'],
                'city_id'           => $member['city_id'],
//                'password'          => $member['password'],
                'is_vetified'       => $member['is_vetified'],
                'email_verified_at' => $member['email_verified_at'],
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);
        }
    }
}
