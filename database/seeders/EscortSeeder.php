<?php

namespace Database\Seeders;

use App\Models\Escort;

class EscortSeeder extends BaseSeeder
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

        Escort::factory(100)->create();
    }
}
