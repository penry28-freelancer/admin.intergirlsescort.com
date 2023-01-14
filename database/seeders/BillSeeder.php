<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('bills')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $escorts_ids  = \DB::table('accounts')->where('accountable_type', 'App\Models\Escort')->pluck('id')->toArray();
        $agencies_ids = \DB::table('accounts')->where('accountable_type', 'App\Models\Agency')->pluck('id')->toArray();
        $clubs_ids    = \DB::table('accounts')->where('accountable_type', 'App\Models\Club')->pluck('id')->toArray();

        for ($i=0; $i < 100; $i++) {
            $escort_id  = $escorts_ids[array_rand($escorts_ids)];
            $escortBill = \DB::table('bills')->where('account_id', $escort_id)->first();

            if (!$escortBill) {
                \DB::table('bills')->insert([
                    'first_name'        => 'Escort ' . $i,
                    'last_name'         => '001',
                    'account_id'        => $escort_id,
                    'phone'             => '012345678',
                    'address'           => 'HCM',
                    'zip_code'          => '700000',
                    'city_id'           => 1,
                    'country_id'        => 1,
                    'company_name'      => '',
                    'identity_number'   => '',
                    'vat_id'            => '',
                ]);
            }
        }

        for ($i=0; $i < 100; $i++) {
            $agency_id  = $agencies_ids[array_rand($agencies_ids)];
            $agencyBill = \DB::table('bills')->where('account_id', $agency_id)->first();

            if (!$agencyBill) {
                \DB::table('bills')->insert([
                    'first_name'        => 'Agency ' . $i,
                    'last_name'         => '001',
                    'account_id'        => $agency_id,
                    'phone'             => '012345678',
                    'address'           => 'HCM',
                    'zip_code'          => '700000',
                    'city_id'           => 1,
                    'country_id'        => 1,
                    'company_name'      => '',
                    'identity_number'   => '',
                    'vat_id'            => '',
                ]);
            }
        }

        for ($i=0; $i < 100; $i++) {
            $club_id = $clubs_ids[array_rand($clubs_ids)];
            $clubBill = \DB::table('bills')->where('account_id', $club_id)->first();

            if (!$clubBill) {
                \DB::table('bills')->insert([
                    'first_name'        => 'Club ' . $i,
                    'last_name'         => '001',
                    'account_id'        => $club_id,
                    'phone'             => '012345678',
                    'address'           => 'HCM',
                    'zip_code'          => '700000',
                    'city_id'           => 1,
                    'country_id'        => 1,
                    'company_name'      => '',
                    'identity_number'   => '',
                    'vat_id'            => '',
                ]);
            }
        }
    }
}
