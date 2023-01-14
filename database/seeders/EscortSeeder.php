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
        \DB::table('accounts')->where('accountable_type', 'App\Models\Escort')->delete();
        \DB::table('escort_language')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Escort::factory(100)->create();
    }
}
