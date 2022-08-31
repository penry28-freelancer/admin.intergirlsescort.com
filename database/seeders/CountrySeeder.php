<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries_1 = [
            'Albania',
            'Armenia',
            'Austria',
            'Belarus',
            'Belgium',
            'Bosnia Herzegovina',
            'Bulgaria',
            'Croatia',
            'Cyprus',
            'Czech Republic',
            'Denmark',
            'Estonia',
            'Finland',
            'France',
            'Germany',
            'Greece',
            'Hungary',
            'Iceland',
            'Ireland',
            'Italy',
            'Kosovo',
            'Latvia',
            'Liechtenstein',
            'Lithuania',
            'Luxembourg',
            'Malta',
            'Moldova',
            'Monaco',
            'Montenegro',
            'Netherlands',
            'North Macedonia',
            'Norway',
            'Poland',
            'Portugal',
            'Romania',
            'Russia',
            'Serbia',
            'Slovakia',
            'Slovenia',
            'Spain',
            'Sweden',
            'Switzerland',
            'Turkey',
            'UK',
            'Ukraine',
        ];

        $countries_2 = [
            'Algeria',
            'Argentina',
            'Australia',
            'Azerbaijan',
            'Bahrain',
            'Benin',
            'Brazil',
            'Burkina Faso',
            'Cambodia',
            'Cameroon',
            'Canada',
            'Caribbean',
            'Chile',
            'China',
            'Colombia',
            'Costarica',
            'DR Congo',
            'Ecuador',
            'Egypt',
            'French Polynesia',
            'Georgia',
            'Ghana',
            'Guatemala',
            'India',
            'Indonesia',
            'Iran',
            'Israel',
            'Ivory Coast',
            'Jamaica',
            'Japan',
            'Jordan',
            'Kazakhstan',
            'Kenya',
            'Kuwait',
            'Laos',
            'Lebanon',
            'Malaysia',
            'Mali',
            'Mexico',
            'Mongolia',
            'Morocco',
            'Nepal',
            'New Zealand',
            'Nicaragua',
            'Nigeria',
            'Oman',
            'Pakistan',
            'Panama',
            'Paraguay',
            'Peru',
            'Philippines',
            'Qatar',
            'Saudi Arabia',
            'Senegal',
            'Singapore',
            'South Africa',
            'South Korea',
            'Sri Lanka',
            'Taiwan',
            'Tanzania',
            'Thailand',
            'Tunisia',
            'UAE',
            'Uganda',
            'Uruguay',
            'USA',
            'Uzbekistan',
            'Venezuela',
            'Vietnam',
            'Zambia',
        ];

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('countries')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach($countries_1 as $country) {
            \DB::table('countries')->insert([
                'name' => $country,
                'group_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach($countries_2 as $country) {
            \DB::table('countries')->insert([
                'name' => $country,
                'group_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
