<?php

namespace Database\Seeders;

use App\Models\Member;
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
                'email'             => 'member001@gmail.com',
                'password'          => \Hash::make('12345678Ad'),
                'country_id'        => 1,
                'city_id'           => 1,
            ],
            [
                'name'              => 'Howard',
                'email'             => 'member002@gmail.com',
                'password'          => \Hash::make('12345678Ad'),
                'country_id'        => 1,
                'city_id'           => 1,
            ],
            [
                'name'              => 'Tobin',
                'email'             => 'member003@gmail.com',
                'password'          => \Hash::make('12345678Ad'),
                'country_id'        => 1,
                'city_id'           => 1,
            ],
        ];

        foreach ($members as $member) {
            $memberCreated = Member::create([
                'country_id'        => $member['country_id'],
                'city_id'           => $member['city_id'],
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);
            $memberCreated->accountable()->create([
                'name'              => $member['name'],
                'email'             => $member['email'],
                'password'          => $member['password'],
            ]);
        }
    }
}
