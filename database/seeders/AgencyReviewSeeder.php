<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AgencyReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('agency_reviews')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $date_now = Carbon::now();

        \DB::table('agency_reviews')->insert([
            [
                'nickname'       => 'Nickname 1',
                'agency_id'      => 1,
                'rating'         => 2,
                'comment'        => '1 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'is_verified'    => 0,
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 2',
                'agency_id'      => 1,
                'rating'         => 2,
                'comment'        => '2 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'is_verified'    => 0,
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 3',
                'agency_id'      => 1,
                'rating'         => 2,
                'comment'        => '3 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'is_verified'    => 0,
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 4',
                'agency_id'      => 1,
                'rating'         => 2,
                'comment'        => '4 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'is_verified'    => 0,
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 5',
                'agency_id'      => 1,
                'rating'         => 1,
                'comment'        => '5 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'is_verified'    => 0,
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 6',
                'agency_id'      => 1,
                'rating'         => 2,
                'comment'        => '6 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'is_verified'    => 0,
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 7',
                'agency_id'      => 1,
                'rating'         => 3,
                'comment'        => '7 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'is_verified'    => 0,
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 8',
                'agency_id'      => 1,
                'rating'         => 4,
                'comment'        => '8 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'is_verified'    => 0,
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
            [
                'nickname'       => 'Nickname 9',
                'agency_id'      => 1,
                'rating'         => 5,
                'comment'        => '9 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo, sit.',
                'is_verified'    => 0,
                'created_at'     => $date_now,
                'updated_at'     => $date_now,
            ],
        ]);
    }
}
