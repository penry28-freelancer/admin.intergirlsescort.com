<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('clubs')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $clubs = [
            [
                'name'        => 'Milan',
                'hours_text'  => 'Po - SO 10hr-22hr, Ne 12-20 hod',
                'website_url' => 'www.cherry-massage.cz',
                'phone_1'     => '+420 774 292 109',
                'phone_2'     => '',
                'address'     => 'Za Poříčskou Branou 16, Praha 8 - Karlín, 180 00',
            ],
            [
                'name'        => 'Berlin',
                'hours_text'  => 'Mo - Sat 10hr-22hr, Su 12-20 hod',
                'website_url' => 'https://vinneri.pl/',
                'phone_1'     => '+48 797 300 706',
                'phone_2'     => '',
                'address'     => 'Augustyna Necla 8a/12, Gdynia',
            ],
            [
                'name'        => 'Paris',
                'hours_text'  => '22:00-06:00',
                'website_url' => 'https://www.charlotte.am',
                'phone_1'     => '+374 412 770 20',
                'phone_2'     => '',
                'address'     => '25 Baghramyan ave',
            ],
            [
                'name'        => 'London',
                'hours_text'  => 'Friday: 10:00 – 3:00',
                'website_url' => 'Gr-club.de',
                'phone_1'     => '+49 175 265 1904',
                'phone_2'     => '',
                'address'     => 'Za Poříčskou Branou 16, Praha 8 - Karlín, 180 00',
            ],
            [
                'name'        => 'Madrid',
                'hours_text'  => 'Po - SO 10hr-22hr, Ne 12-20 hod',
                'website_url' => 'www.cherry-massage.cz',
                'phone_1'     => '+420 774 292 109',
                'phone_2'     => '',
                'address'     => 'Za Poříčskou Branou 16, Praha 8 - Karlín, 180 00',
            ],
        ];

        foreach ($clubs as $club) {
            \DB::table('tours')->insert([
                'title'      => $tour,
                'start_date' => Carbon::now(),
                'end_date'   => Carbon::now(),
                'country_id' => 1,
                'city_id'    => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
