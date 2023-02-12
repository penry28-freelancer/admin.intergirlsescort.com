<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountryGroupSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(DaySeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(PageContentSeeder::class);
        $this->call(TimeZoneSeeder::class);
    }
}
