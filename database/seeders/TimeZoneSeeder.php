<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TimeZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('time_zones')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $time_zones = json_decode(file_get_contents(__DIR__.'/data/timezone.json'), true);
        $date_now = Carbon::now();

        foreach ($time_zones as $timezone) {
            \DB::table('time_zones')->insert([
                'zone' => $timezone['zone'],
                'gmt' => $timezone['gmt'],
                'name' => $timezone['name'],
                'created_at' => $date_now,
                'updated_at' => $date_now,
            ]);
        }
    }
}
