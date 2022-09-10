<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdvertiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('advertises')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $date_now = Carbon::now();

        \DB::table('advertises')->insert([
            [
                'id' => 1,
                'name' => 'Advertise 1',
                'created_at' => $date_now,
                'updated_at' => $date_now,
            ],
            [
                'id' => 2,
                'name' => 'Advertise 1',
                'created_at' => $date_now,
                'updated_at' => $date_now,
            ],
        ]);

        \DB::table('advertise_links')->insert([
            [
                'id' => 1,
                'url' => '<a href="https://www.eurogirlsescort.com" target="_blank" title="EuroGirlsEscort.com"><img src="https://www.eurogirlsescort.com/dist/images/banners/300X100.jpg" alt="EuroGirlsEscort.com" title="EuroGirlsEscort.com"></a>',
                'advertise_id' => 1,
                'created_at' => $date_now,
                'updated_at' => $date_now,
            ],
            [
                'id' => 2,
                'url' => '<a href="https://www.eurogirlsescort.com" target="_blank" title="EuroGirlsEscort.com"><img src="https://www.eurogirlsescort.com/dist/images/banners/728X90.jpg" alt="EuroGirlsEscort.com" title="EuroGirlsEscort.com"></a>',
                'advertise_id' => 1,
                'created_at' => $date_now,
                'updated_at' => $date_now,
            ],
            [
                'id' => 3,
                'url' => '<a href="https://www.eurogirlsescort.com" target="_blank" title="EuroGirlsEscort.com"><img src="https://www.eurogirlsescort.com/dist/images/banners/120X240.jpg" alt="EuroGirlsEscort.com" title="EuroGirlsEscort.com"></a>',
                'advertise_id' => 1,
                'created_at' => $date_now,
                'updated_at' => $date_now,
            ],
            [
                'id' => 4,
                'url' => '<a href="https://www.eurogirlsescort.com" target="_blank" title="EuroGirlsEscort.com"><img src="https://www.eurogirlsescort.com/dist/images/banners/96X60.jpg" alt="EuroGirlsEscort.com" title="EuroGirlsEscort.com"></a>',
                'advertise_id' => 2,
                'created_at' => $date_now,
                'updated_at' => $date_now,
            ],
        ]);
    }
}
