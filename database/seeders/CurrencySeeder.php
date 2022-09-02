<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('currencies')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $currencies = json_decode(file_get_contents(__DIR__.'/data/currencies.json'), true);
        $date_now = Carbon::now();

        foreach ($currencies as $currency) {
            \DB::table('currencies')->insert([
                'name' => $currency['name'],
                'created_at' => $date_now,
                'updated_at' => $date_now,
            ]);
        }
    }
}
