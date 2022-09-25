<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AffilateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('affilates')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $affilates = [
            [
                'name'      => 'Denis',
                'tax_id'    => '123456',
                'website'   => 'https://vinneri.pl/',
                'full_name' => 'Denis Lee',
                'address'   => 'Za Poříčskou Branou 16, Praha 8 - Karlín, 180 00',
                'zip_code'  => '120000',
                'city'      => 'Milan',
                'country'   => 'Italia',
                'phone'     => '+420 774 292 109',
                'email'      => 'denis@gmail.com',
                'password'  => \Hash::make('12345678'),
            ],
            [
                'name'      => 'Howard',
                'tax_id'    => '123456',
                'website'   => 'https://vinneri.pl/',
                'full_name' => 'Howard Lee',
                'address'   => 'Za Poříčskou Branou 16, Praha 8 - Karlín, 180 00',
                'zip_code'  => '120000',
                'city'      => 'Berlin',
                'country'   => 'Germany',
                'phone'     => '+420 774 292 110',
                'email'      => 'howard@gmail.com',
                'password'  => \Hash::make('12345678'),
            ],
            [
                'name'      => 'Tobin',
                'tax_id'    => '123456',
                'website'   => 'https://vinneri.pl/',
                'full_name' => 'Tobin Lee',
                'address'   => 'Za Poříčskou Branou 16, Praha 8 - Karlín, 180 00',
                'zip_code'  => '120000',
                'city'      => 'Milan',
                'country'   => 'Italia',
                'phone'     => '+420 774 292 111',
                'email'      => 'tobin@gmail.com',
                'password'  => \Hash::make('12345678'),
            ],
        ];

        foreach ($affilates as $affilate) {
            \DB::table('affilates')->insert([
                'name'       => $affilate['name'],
                'tax_id'     => $affilate['tax_id'],
                'website'    => $affilate['website'],
                'full_name'  => $affilate['full_name'],
                'address'    => $affilate['address'],
                'zip_code'   => $affilate['zip_code'],
                'city'       => $affilate['city'],
                'country'    => $affilate['country'],
                'phone'      => $affilate['phone'],
                'email'       => $affilate['email'],
                'password'   => $affilate['password'],
                'is_verify'  => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
