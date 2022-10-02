<?php

namespace Database\Seeders;

use App\Models\Advertise;
use Illuminate\Database\Seeder;

class AdvertiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('advertises')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Advertise::factory()->count(10)->create();
    }
}
