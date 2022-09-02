<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EscortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('escorts')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \DB::table('escorts')->insert([
            'name'                => 'Escort 1',
            'nickname'            => 'Escort 1',
            'organization'        => 'Escort',
            'last_seen_online_at' => Carbon::now(),
            'bio'                 => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, harum.',
            'gender'              => 1,
            'birthday'            => Carbon::now(),
            'location'            => 'location',
            'eyes_id'             => 1,
            'hair_color_id'       => 1,
            'hair_length_id'      => 1,
            'public_hair_id'      => 1,
            'bust_size_id'        => 1,
            'bust_type_id'        => 1,
            'travel_id'           => 1,
            'height_id'           => 1,
            'ethnicity_id'        => 1,
            'orientation_id'      => 1,
            'smoker_id'           => 1,
            'nationality_id'      => 1,
            'service_content'     => 'service_content',
            'available_for'       => 'available_for',
            'meeting_with'        => 'meeting_with',
            'phone'               => '0385763717',
            'country_id'          => 1,
            'city_id'             => 1,
            'is_verified'         => 0,
            'is_top'              => 0,
            'is_vip'              => 0,
            'video_id'            => NULL,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
    }
}
