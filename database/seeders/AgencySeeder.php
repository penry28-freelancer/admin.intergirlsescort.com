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

        \DB::table('agencies')->insert([
            'name'                => 'Agency 01',
            'location'            => 'Location',
            'bio'                 => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt, officia.',
            'phone'               => '0385763717',
            'email'               => 'phamdinhhung@gmail.com',
            'last_seen_online_at' => Carbon::now(),
            'country_id'          => 1,
            'city_id'             => 1,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
    }
}
