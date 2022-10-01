<?php

namespace Database\Seeders;

use App\Models\ClubReview;
use Illuminate\Database\Seeder;

class ClubReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('club_reviews')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        ClubReview::factory()->count(100)->create();
    }
}
