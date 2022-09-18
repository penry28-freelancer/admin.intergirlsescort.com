<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClientReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('client_reports')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $client_reports = [
            [
                'nick_name'          => 'Penis',
                'name_of_escost'     => 'Tadi',
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
                'name_of_escost'     => 'Vin',
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
                'name_of_escost'     => 'Tobin',
                'country_id'         => 1,
                'city_id'            => 1,
                'calling_country_id' => 1,
                'phone'              => '0123456787',
                'email'              => 'tyson@gmail.com',
                'description'        => 'Tobin',
                'verified_at'        => Carbon::now(),
            ],
        ];

        foreach ($client_reports as $client_report) {
            \DB::table('client_reports')->insert([
                'nick_name'          => $client_report['nick_name'],
                'name_of_escost'     => $client_report['name_of_escost'],
                'country_id'         => $client_report['country_id'],
                'city_id'            => $client_report['city_id'],
                'calling_country_id' => $client_report['calling_country_id'],
                'phone'              => $client_report['phone'],
                'email'              => $client_report['email'],
                'description'        => $client_report['description'],
                'verified_at'        => $client_report['verified_at'],
                'created_at'         => Carbon::now(),
                'updated_at'         => Carbon::now(),
            ]);
        }
    }
}
