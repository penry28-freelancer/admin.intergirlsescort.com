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

        $agencies_ids = \DB::table('agencies')->pluck('id')->toArray();
        $escorts_ids  = \DB::table('escorts')->pluck('id')->toArray();

        for ($i=0; $i < 10; $i++) {
            $agency_id = $agencies_ids[array_rand($agencies_ids)];
            if (!\DB::table('transactions')->where('account_id', $agency_id)->first()) {
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

        for ($i=0; $i < 10; $i++) {
            $escort_id = $escorts_ids[array_rand($escorts_ids)];
            if (!\DB::table('transactions')->where('account_id', $escort_id)->first()) {
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
    }
}
