<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('languages')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $languages = json_decode(file_get_contents(__DIR__.'/data/languages.json'), true);

        foreach ($languages as $language) {
            \DB::table('languages')->insert([
                'name' => $language,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
