<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(CountryGroupSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(TourSeeder::class);
    }
}
