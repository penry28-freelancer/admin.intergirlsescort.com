<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscortTourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tours')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $country_ids = DB::table('countries')->pluck('id')->toArray();
        $city_ids = DB::table('cities')->pluck('id')->toArray();

        $escorts = DB::table('escorts')
            ->whereNotNull('agency_id')
            ->get();

        $now = Carbon::now();

        $escord_tours = [];
        foreach($escorts as $escort) {
            $number_of_tours = random_int(1, 10);

            $start = random_int(0, 365);
            $end = $start - random_int(0, 10);
            $startDate = Carbon::now()->subDay($start);
            $endDate = Carbon::now()->subDay($end);

            while($number_of_tours--) {
                $escord_tours[] = [
                    'escort_id' => $escort->id,
                    'agency_id' => $escort->agency_id,
                    'title' => 'Title',
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'country_id' => $country_ids[array_rand($country_ids)],
                    'city_id' => $city_ids[array_rand($city_ids)],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        DB::table('tours')->insert($escord_tours);
    }
}
