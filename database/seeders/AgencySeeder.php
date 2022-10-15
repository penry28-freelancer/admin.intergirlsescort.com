<?php

namespace Database\Seeders;

use App\Models\Agency;
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
        \DB::table('accounts')->where('accountable_type', 'App\Models\Agency')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Agency::factory(100)->create();
    }
}
