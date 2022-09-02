<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('tours')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $tours = [
            'Milan',
            'BerLin',
            'Manchester',
        ];

        foreach ($tours as $tour) {
            \DB::table('tours')->insert([
                'title' => $tour,
                'start_date' => Carbon::now(),
                'end_date'   => Carbon::now(),
                'country_id' => 1,
                'city_id'    => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
