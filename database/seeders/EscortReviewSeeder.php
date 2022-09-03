<?php

namespace Database\Seeders;

use Carbon\Carbon;

class EscortReviewSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('escort_reviews')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $date_now = Carbon::now();

        \DB::table('escort_reviews')->insert([
            [
                'nickname'       => 'Nickname 1',
                'country_id'     => 1,
                'city_id'        => 1,
                'escort_id'      => 1,
                'meeting_date'   => $date_now,
                'meeting_length' => 'Metting length',
                'price'          => 10000,
                'currency_id'    => 1,
                'rating'         => 2,
                'comment'        => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 2',
                'country_id'     => 1,
                'city_id'        => 1,
                'escort_id'      => 1,
                'meeting_date'   => $date_now,
                'meeting_length' => 'Metting length',
                'price'          => 10000,
                'currency_id'    => 1,
                'rating'         => 2,
                'comment'        => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 3',
                'country_id'     => 1,
                'city_id'        => 1,
                'escort_id'      => 1,
                'meeting_date'   => $date_now,
                'meeting_length' => 'Metting length',
                'price'          => 10000,
                'currency_id'    => 1,
                'rating'         => 2,
                'comment'        => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 4',
                'country_id'     => 1,
                'city_id'        => 1,
                'escort_id'      => 1,
                'meeting_date'   => $date_now,
                'meeting_length' => 'Metting length',
                'price'          => 10000,
                'currency_id'    => 1,
                'rating'         => 2,
                'comment'        => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 5',
                'country_id'     => 1,
                'city_id'        => 1,
                'escort_id'      => 1,
                'meeting_date'   => $date_now,
                'meeting_length' => 'Metting length',
                'price'          => 10000,
                'currency_id'    => 1,
                'rating'         => 2,
                'comment'        => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 6',
                'country_id'     => 1,
                'city_id'        => 1,
                'escort_id'      => 1,
                'meeting_date'   => $date_now,
                'meeting_length' => 'Metting length',
                'price'          => 10000,
                'currency_id'    => 1,
                'rating'         => 2,
                'comment'        => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 7',
                'country_id'     => 1,
                'city_id'        => 1,
                'escort_id'      => 1,
                'meeting_date'   => $date_now,
                'meeting_length' => 'Metting length',
                'price'          => 10000,
                'currency_id'    => 1,
                'rating'         => 2,
                'comment'        => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 8',
                'country_id'     => 1,
                'city_id'        => 1,
                'escort_id'      => 1,
                'meeting_date'   => $date_now,
                'meeting_length' => 'Metting length',
                'price'          => 10000,
                'currency_id'    => 1,
                'rating'         => 2,
                'comment'        => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 9',
                'country_id'     => 1,
                'city_id'        => 1,
                'escort_id'      => 1,
                'meeting_date'   => $date_now,
                'meeting_length' => 'Metting length',
                'price'          => 10000,
                'currency_id'    => 1,
                'rating'         => 2,
                'comment'        => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
        ]);
    }
}
