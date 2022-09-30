<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClubBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('club_banners')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $club_banners = [
            [
                'banner_image' => asset('storage/banner/banner_1.jpg'),
                'website_url'  => 'booking.something.vm/',
                'club_id'      => 1,
            ],
            [
                'banner_image' => asset('storage/banner/banner_2.jpg'),
                'website_url'  => 'booking.something.vm/',
                'club_id'      => 1,
            ],
        ];

        foreach ($club_banners as $club_banner) {
            \DB::table('club_banners')->insert([
                'banner_image' => $club_banner['banner_image'],
                'website_url'  => $club_banner['website_url'],
                'club_id'      => $club_banner['club_id'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ]);
        }
    }
}
