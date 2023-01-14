<?php

namespace Database\Seeders;

use Carbon\Carbon;

class CountryGroupSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('country_groups')->truncate();
        \DB::table('countries')->truncate();
        \DB::table('cities')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $countries_groups = json_decode(file_get_contents(__DIR__.'/data/countries.json'), true);
        $calling_code = json_decode(file_get_contents(__DIR__.'/data/calling_code.json'), true);

        $date_now = Carbon::now();

        foreach ($countries_groups as $group) {
            $group_id = \DB::table('country_groups')->insertGetId([
                'name' => $group['name'],
                'created_at' => $date_now,
                'updated_at' => $date_now,
            ]);

            foreach ($group['countries'] as $country) {
                $country_name = $country['name'];
                $calling_code_selected = null;

                foreach ($calling_code as $item) {
                    $code_name = explode("#", $item['name']);
                    if ($code_name[0] === strtolower($country_name)) {
                        $calling_code_selected = trim($item['code']);
                    }
                }

                $country_id = \DB::table('countries')->insertGetId([
                    'name' => $country_name,
                    'slug' => \Str::slug($country_name),
                    'full_name' => $country['name'],
                    'calling_code' => $calling_code_selected,
                    'flag_image' => $country['flag_image'],
                    'group_id' => $group_id,
                    'created_at' => $date_now,
                    'updated_at' => $date_now,
                ]);

                foreach ($country['cities'] as $city) {
                    \DB::table('cities')->insert([
                        'name' => $city['name'],
                        'slug' => \Str::slug($city['name']),
                        'country_id' => $country_id,
                        'created_at' => $date_now,
                        'updated_at' => $date_now,
                    ]);
                }
            }
        }
    }
}
