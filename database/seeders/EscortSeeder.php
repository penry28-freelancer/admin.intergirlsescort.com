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
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
    }
}
