<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EscostReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('escost_reports')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $escost_reports = [
            [
                'nick_name'          => 'Penis',
                'name_of_escost'     => 'Tadi Escost',
                'country_id'         => 1,
                'city_id'            => 1,
                'calling_country_id' => 1,
                'phone'              => '0123456789',
                'email'              => 'penis@gmail.com',
                'description'        => 'Tadi',
                'verified_at'        => Carbon::now(),
            ],
            [
                'nick_name'          => 'Howard',
                'name_of_escost'     => 'Vin Escost',
                'country_id'         => 1,
                'city_id'            => 1,
                'calling_country_id' => 1,
                'phone'              => '0123456788',
                'email'              => 'howard@gmail.com',
                'description'        => 'Vin',
                'verified_at'        => Carbon::now(),
            ],
            [
                'nick_name'          => 'Tyson',
                'name_of_escost'     => 'Tobin Escost',
                'country_id'         => 1,
                'city_id'            => 1,
                'calling_country_id' => 1,
                'phone'              => '0123456787',
                'email'              => 'tyson@gmail.com',
                'description'        => 'Tobin',
                'verified_at'        => Carbon::now(),
            ],
        ];

        foreach ($escost_reports as $escost_report) {
            \DB::table('escost_reports')->insert([
                'nick_name'          => $escost_report['nick_name'],
                'name_of_escost'     => $escost_report['name_of_escost'],
                'country_id'         => $escost_report['country_id'],
                'city_id'            => $escost_report['city_id'],
                'date_added'         => Carbon::now(),
                'calling_country_id' => $escost_report['calling_country_id'],
                'phone'              => $escost_report['phone'],
                'email'              => $escost_report['email'],
                'description'        => $escost_report['description'],
                'verified_at'        => $escost_report['verified_at'],
                'created_at'         => Carbon::now(),
                'updated_at'         => Carbon::now(),
            ]);
        }
    }
}
