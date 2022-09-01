<?php

namespace Database\Seeders;

use Carbon\Carbon;

class ServiceSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('services')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $services = [
            'Dirty talk',
            'Foot fetish',
            'GFE',
            'Sex Toys',
            'Squirting',
            'Uniforms',
            'Domination',
            'Duo with girl',
            'French kissing'
        ];

        foreach ($services as $service) {
            \DB::table('services')->insert([
                'name' => $service,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
