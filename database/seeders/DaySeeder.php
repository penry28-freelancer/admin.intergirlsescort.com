<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('days')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \DB::table('days')->insert([
            [
                'id'         => 1,
                'name'       => 'Monday',
                'order'      => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'         => 2,
                'order'      => 2,
                'name'       => 'Tuesday',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'         => 3,
                'order'      => 3,
                'name'       => 'Wednesday',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'         => 4,
                'order'      => 4,
                'name'       => 'Thursday',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'         => 5,
                'order'      => 5,
                'name'       => 'Friday',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'         => 6,
                'order'      => 6,
                'name'       => 'Saturday',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'         => 7,
                'order'      => 7,
                'name'       => 'Sunday',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
