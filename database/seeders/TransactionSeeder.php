<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('transactions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $transactions = [
            [
                'transaction_id'    => '1212',
                'account_id'        => 1,
                'payment_type'      => 1,
                'price_id'          => 2,
                'price_num'         => 50,
                'status'            => 1,
            ],
            [
                'transaction_id'    => '1212',
                'account_id'        => 1,
                'payment_type'      => 1,
                'price_id'          => 3,
                'price_num'         => 90,
                'status'            => 1,
            ],
            [
                'transaction_id'    => '1212',
                'account_id'        => 2,
                'payment_type'      => 1,
                'price_id'          => 2,
                'price_num'         => 50,
                'status'            => 1,
            ],
            [
                'transaction_id'    => '1212',
                'account_id'        => 3,
                'payment_type'      => 1,
                'price_id'          => 2,
                'price_num'         => 50,
                'status'            => 1,
            ],
            [
                'transaction_id'    => '1212',
                'account_id'        => 4,
                'payment_type'      => 1,
                'price_id'          => 2,
                'price_num'         => 50,
                'status'            => 1,
            ]
        ];

        foreach ($transactions as $transaction)
        {
            DB::table('transactions')->insert($transaction);
        }
    }
}
