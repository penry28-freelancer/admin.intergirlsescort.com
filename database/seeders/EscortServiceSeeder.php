<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscortServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('escort_service')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $escort_ids = DB::table('escorts')->pluck('id')->toArray();
        $service_ids = DB::table('services')->pluck('id')->toArray();

        $escorts_services = [];

        $now = Carbon::now();
        foreach($escort_ids as $escort_id) {
            $is_included = random_int(0, 1);
            $number_escort_service = random_int(1, 30);
            $blacklist_ids = [];
            while($number_escort_service--) {
                $service_id = array_rand($service_ids);
                // check escort exist service
                while(in_array($service_id, $blacklist_ids)) {
                    $service_id = array_rand($service_ids);
                }

                $escorts_services[] = [
                    'escort_id'     => $escort_id,
                    'service_id'    => $service_ids[$service_id],
                    'is_included'   => $is_included,
                    'extra_price'   => !$is_included ? random_int(1000, 70000) : 0,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ];

                $blacklist_ids[] = $service_id;
            }
        }


        DB::table('escort_service')->insert($escorts_services);
    }
}
