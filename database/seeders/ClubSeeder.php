<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
        \DB::table('club_hours')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $clubs = [
            [
                'name'        => 'Milan',
                'website_url' => 'www.cherry-massage.cz',
                'phone_1'     => '+420 774 292 109',
                'phone_2'     => '',
                'address'     => 'Za Poříčskou Branou 16, Praha 8 - Karlín, 180 00',
                'club_hours'  => ['12:00 - 22:00', '1:00 - 7:00'],
            ],
            [
                'name'        => 'Berlin',
                'website_url' => 'https://vinneri.pl/',
                'phone_1'     => '+48 797 300 706',
                'phone_2'     => '',
                'address'     => 'Augustyna Necla 8a/12, Gdynia',
                'club_hours'  => ['12:00 - 22:00', '1:00 - 7:00'],
            ],
            [
                'name'        => 'Paris',
                'website_url' => 'https://www.charlotte.am',
                'phone_1'     => '+374 412 770 20',
                'phone_2'     => '',
                'address'     => '25 Baghramyan ave',
                'club_hours'  => ['18:00 - 3:00'],
            ],
            [
                'name'        => 'London',
                'website_url' => 'Gr-club.de',
                'phone_1'     => '+49 175 265 1904',
                'phone_2'     => '',
                'address'     => 'Za Poříčskou Branou 16, Praha 8 - Karlín, 180 00',
                'club_hours'  => ['18:00 - 3:00'],
            ],
            [
                'name'        => 'Madrid',
                'website_url' => 'www.cherry-massage.cz',
                'phone_1'     => '+420 774 292 109',
                'phone_2'     => '',
                'address'     => 'Za Poříčskou Branou 16, Praha 8 - Karlín, 180 00',
                'club_hours'  => ['18:00 - 3:00'],
            ],
        ];

        foreach ($clubs as $club) {
            $club_id = \DB::table('clubs')->insertGetId([
                'name'        => $club['name'],
                'website_url' => $club['website_url'],
                'phone_1'     => $club['phone_1'],
                'phone_2'     => $club['phone_2'],
                'country_id'  => 1,
                'city_id'     => 1,
                'address'     => $club['address'],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);

            foreach ($club['club_hours'] as $club_hour) {
                \DB::table('club_hours')->insert([
                    'title'      => $club_hour,
                    'club_id'    => $club_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
