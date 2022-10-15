<?php

namespace Database\Seeders;

use App\Models\Club;
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('clubs')->truncate();
        \DB::table('accounts')->where('accountable_type', 'App\Models\Club')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Club::factory(100)->create();
    }
}
