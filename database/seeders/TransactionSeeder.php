<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('transactions')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $escorts_ids  = \DB::table('accounts')->where('accountable_type', 'App\Models\Escort')->pluck('id')->toArray();
        $agencies_ids = \DB::table('accounts')->where('accountable_type', 'App\Models\Agency')->pluck('id')->toArray();
        $clubs_ids    = \DB::table('accounts')->where('accountable_type', 'App\Models\Club')->pluck('id')->toArray();

        for ($i=0; $i < 100; $i++) {
            $escort_id = $escorts_ids[array_rand($escorts_ids)];
            $escortTransaction = \DB::table('transactions')->where('account_id', $escort_id)->first();

            if (!$escortTransaction) {
                \DB::table('transactions')->insert([
                    'transaction_id'    => '1212',
                    'account_id'        => $escort_id,
                    'payment_type'      => 1,
                    'price_id'          => 2,
                    'price_num'         => 50,
                    'status'            => 1,
                ]);
            }
        }

        for ($i=0; $i < 100; $i++) {
            $agency_id = $agencies_ids[array_rand($agencies_ids)];
            $agencyTransaction = \DB::table('transactions')->where('account_id', $agency_id)->first();

            if (!$agencyTransaction) {
                \DB::table('transactions')->insert([
                    'transaction_id'    => '1212',
                    'account_id'        => $agency_id,
                    'payment_type'      => 1,
                    'price_id'          => 2,
                    'price_num'         => 50,
                    'status'            => 1,
                ]);
            }
        }

        for ($i=0; $i < 100; $i++) {
            $club_id = $clubs_ids[array_rand($clubs_ids)];
            $agencyTransaction = \DB::table('transactions')->where('account_id', $club_id)->first();

            if (!$agencyTransaction) {
                \DB::table('transactions')->insert([
                    'transaction_id'    => '1212',
                    'account_id'        => $club_id,
                    'payment_type'      => 1,
                    'price_id'          => 2,
                    'price_num'         => 50,
                    'status'            => 1,
                ]);
            }
        }
    }
}
