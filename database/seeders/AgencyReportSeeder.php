<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AgencyReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('agency_reports')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $agency_reports = [
            [
                'nick_name'          => 'Penis',
                'name_of_agency'     => 'Tadi',
                'country_id'         => 1,
                'city_id'            => 1,
                'website'            => 'http://booking.something.vm/',
                'calling_country_id' => 1,
                'phone'              => '0123456789',
                'email'              => 'penis@gmail.com',
                'description'        => 'Tadi',
                'verified_at'        => Carbon::now(),
            ],
            [
                'nick_name'          => 'Howard',
                'name_of_agency'     => 'Vin',
                'country_id'         => 1,
                'city_id'            => 1,
                'website'            => 'http://booking.something.vm/',
                'calling_country_id' => 1,
                'phone'              => '0123456788',
                'email'              => 'howard@gmail.com',
                'description'        => 'Vin',
                'verified_at'        => Carbon::now(),
            ],
            [
                'nick_name'          => 'Tyson',
                'name_of_agency'     => 'Tobin',
                'country_id'         => 1,
                'city_id'            => 1,
                'website'            => 'http://booking.something.vm/',
                'calling_country_id' => 1,
                'phone'              => '0123456787',
                'email'              => 'tyson@gmail.com',
                'description'        => 'Tobin',
                'verified_at'        => Carbon::now(),
            ],
        ];

        foreach ($agency_reports as $agency_report) {
            \DB::table('agency_reports')->insert([
                'nick_name'          => $agency_report['nick_name'],
                'name_of_agency'     => $agency_report['name_of_agency'],
                'country_id'         => $agency_report['country_id'],
                'city_id'            => $agency_report['city_id'],
                'website'            => $agency_report['website'],
                'calling_country_id' => $agency_report['calling_country_id'],
                'phone'              => $agency_report['phone'],
                'email'              => $agency_report['email'],
                'description'        => $agency_report['description'],
                'verified_at'        => $agency_report['verified_at'],
                'created_at'         => Carbon::now(),
                'updated_at'         => Carbon::now(),
            ]);
        }
    }
}
