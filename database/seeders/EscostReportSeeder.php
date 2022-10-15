<?php

namespace Database\Seeders;

use App\Models\EscostReport;
use Illuminate\Database\Seeder;

class EscostReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('escost_reports')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        EscostReport::factory(100)->create();
    }
}
