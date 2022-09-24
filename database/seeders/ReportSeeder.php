<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('reports')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $reports = [
            [
                'nick_name'          => 'Denis',
                'name'               => 'Tadi',
                'country_id'         => 1,
                'city_id'            => 1,
                'website'            => 'http://booking.something.vm/',
                'calling_country_id' => 1,
                'phone'              => '0123456789',
                'email'              => 'penis@gmail.com',
                'description'        => 'Tadi',
                'type'               => 1,
                'verified_at'        => Carbon::now(),
            ],
            [
                'nick_name'          => 'Howard',
                'name'               => 'Vin',
                'country_id'         => 1,
                'city_id'            => 1,
                'website'            => null,
                'calling_country_id' => 1,
                'phone'              => '0123456788',
                'email'              => 'howard@gmail.com',
                'description'        => 'Vin',
                'type'               => 2,
                'verified_at'        => Carbon::now(),
            ],
            [
                'nick_name'          => 'Tyson',
                'name'               => 'Tobin',
                'country_id'         => 1,
                'city_id'            => 1,
                'website'            => null,
                'calling_country_id' => 1,
                'phone'              => '0123456787',
                'email'              => 'tyson@gmail.com',
                'description'        => 'Tobin',
                'type'               => 3,
                'verified_at'        => Carbon::now(),
            ],
        ];

        foreach ($reports as $report) {
            \DB::table('reports')->insert([
                'nick_name'          => $report['nick_name'],
                'name'               => $report['name'],
                'country_id'         => $report['country_id'],
                'city_id'            => $report['city_id'],
                'website'            => $report['website'],
                'calling_country_id' => $report['calling_country_id'],
                'phone'              => $report['phone'],
                'email'              => $report['email'],
                'description'        => $report['description'],
                'type'               => $report['type'],
                'verified_at'        => $report['verified_at'],
                'created_at'         => Carbon::now(),
                'updated_at'         => Carbon::now(),
            ]);
        }
    }
}
