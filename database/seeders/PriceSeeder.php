<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('tours')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $prices = [
            [
                'currency_id'   => 3,
                'price'         => 20,
                'gold'          => 100,
                'you_save'      => 0,
                'is_popular'    => 0,
                'is_best'       => 0,
            ],
            [
                'currency_id'   => 3,
                'price'         => 50,
                'gold'          => 250,
                'you_save'      => 0,
                'is_popular'    => 0,
                'is_best'       => 0,
            ],
            [
                'currency_id'   => 3,
                'price'         => 90,
                'gold'          => 500,
                'you_save'      => 10,
                'is_popular'    => 1,
                'is_best'       => 0,
            ],
            [
                'currency_id'   => 3,
                'price'         => 140,
                'gold'          => 750,
                'you_save'      => 10,
                'is_popular'    => 0,
                'is_best'       => 0,
            ],
            [
                'currency_id'   => 3,
                'price'         => 170,
                'gold'          => 1000,
                'you_save'      => 30,
                'is_popular'    => 0,
                'is_best'       => 0,
            ],
            [
                'currency_id'   => 3,
                'price'         => 320,
                'gold'          => 2000,
                'you_save'      => 80,
                'is_popular'    => 0,
                'is_best'       => 1,
            ],
        ];

//        foreach ()
    }
}
