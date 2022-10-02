<?php

namespace Database\Seeders;

use App\Models\Bill;
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

        $bills = [
            [
                'first_name'        => 'Escort',
                'last_name'         => '001',
                'account_id'         => 4,
                'phone'             => '012345678',
                'address'           => 'HCM',
                'zip_code'          => '700000',
                'city_id'           => 1,
                'country_id'        => 1,
                'company_name'      => '',
                'identity_number'   => '',
                'vat_id'            => '',
            ],
            [
                'first_name'        => 'Escort',
                'last_name'         => '002',
                'account_id'         => 5,
                'phone'             => '012345678',
                'address'           => 'HCM',
                'zip_code'          => '700000',
                'city_id'           => 1,
                'country_id'        => 1,
                'company_name'      => '',
                'identity_number'   => '',
                'vat_id'            => '',
            ],
            [
                'first_name'        => 'Escort',
                'last_name'         => '003',
                'account_id'         => 6,
                'phone'             => '012345678',
                'address'           => 'HCM',
                'zip_code'          => '700000',
                'city_id'           => 1,
                'country_id'        => 1,
                'company_name'      => '',
                'identity_number'   => '',
                'vat_id'            => '',
            ],
            [
                'first_name'        => 'Agency',
                'last_name'         => '001',
                'account_id'         => 1,
                'phone'             => '012345678',
                'address'           => 'HCM',
                'zip_code'          => '700000',
                'city_id'           => 1,
                'country_id'        => 1,
                'company_name'      => '',
                'identity_number'   => '',
                'vat_id'            => '',
            ],
            [
                'first_name'        => 'Agency',
                'last_name'         => '002',
                'account_id'         => 2,
                'phone'             => '012345678',
                'address'           => 'HCM',
                'zip_code'          => '700000',
                'city_id'           => 1,
                'country_id'        => 1,
                'company_name'      => '',
                'identity_number'   => '',
                'vat_id'            => '',
            ],
            [
                'first_name'        => 'Agency',
                'last_name'         => '003',
                'account_id'         => 3,
                'phone'             => '012345678',
                'address'           => 'HCM',
                'zip_code'          => '700000',
                'city_id'           => 1,
                'country_id'        => 1,
                'company_name'      => '',
                'identity_number'   => '',
                'vat_id'            => '',
            ]
        ];

        foreach ($bills as $bill) {
            DB::table('bills')->insert($bill);
        }
    }
}
