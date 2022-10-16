<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscortDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('escort_day')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $escort_ids = DB::table('escorts')->pluck('id')->toArray();
        $day_ids = DB::table('days')->pluck('id')->toArray();

        $now = Carbon::now();

        $escord_days = [];
        foreach($escort_ids as $escort_id) {
            $number_escort_days = random_int(1, 5);
            $blacklist_ids = [];

            $order = 1;
            while($number_escort_days--) {
                $day_id = array_rand($day_ids);
                // check escort exist day
                while(in_array($day_id, $blacklist_ids)) {
                    $day_id = array_rand($day_ids);
                }

                $is_all_day = random_int(0, 1);

                // 60 -> 1
                // 86400 - 60

                $startTime = random_int(0, 23);
                $endTime = random_int($startTime < 23 ? $startTime + 1 : $startTime, 23);

                $from = Carbon::today()->subHour($endTime);
                $to = Carbon::today()->subHour($startTime);

                $escord_days[] = [
                    'escort_id'     => $escort_id,
                    'day_id'        => $day_ids[$day_id],
                    'name'          => "Escort day",
                    'order'         => $order++,
                    'all_day'       => $is_all_day,
                    'from'          => !$is_all_day ? $from : null,
                    'to'            => !$is_all_day ? $to : null,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ];

                $blacklist_ids[] = $day_id;
            }
        }

        DB::table('escort_day')->insert($escord_days);
    }
}
