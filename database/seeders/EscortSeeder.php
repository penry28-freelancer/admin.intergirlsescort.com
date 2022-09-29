<?php

namespace Database\Seeders;

use App\Models\Escort;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EscortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('escorts')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $escorts = [
            [
                'agency_id' => 1,
                'country_id' => 1,
                'city_id' => 1,
                'perex' => 'Perex',
                'sex' => 'woman',
                'birt_year' => '2001',
                'height' => '130',
                'weight' => '42',
                'ethnicity' => 'ebony',
                'hair_color' => 'brown',
                'hair_lenght' => 'medium-long',
                'bust_size' => 'B',
                'bust_type' => 'natural',
                'provides1' => 'outcall-incall',
                'nationality_counter_id' => 1,
                'travel' => 'countrywide',
                'tattoo' => 'yes',
                'piercing' => 'yes',
                'smoker' => 'yes',
                'eye' => 'black',
                'orientation' => 'bisexual',
                'hair_pubic' => 'trimmed',
                'pornstar' => 1,
                'verify_text' => 'Verify text',
                'provides' => 'Provides',
                'meeting_with' => 'man',
                'website' => 'https://website.com',
                'phone1_code' => '84',
                'phone1' => '385763717',
                'phone1_viber' => '',
                'phone1_whatsapp' => '',
                'phone1_wechat' => '',
                'phone1_telegram' => '',
                'phone1_lineapp' => '',
                'phone1_signal' => '',
                'phone1_wechatid' => '',
                'phone1_lineappid' => '',
                'phone1_telegramid' => '',
                'phone2_code' => '',
                'phone2' => '',
                'phone2_viber' => '',
                'phone2_whatsapp' => '',
                'phone2_wechat' => '',
                'phone2_telegram' => '',
                'phone2_lineapp' => '',
                'phone2_signal' => '',
                'phone2_wechatid' => '',
                'phone2_lineappid' => '',
                'phone2_telegramid' => '',
                'video' => '',
                'counter_currency_id' => 1,
                'rate_incall_30' => 18,
                'rate_outvall_30' => 895,
                'rate_incall_1' => 27,
                'rate_outvall_1' => 1790,
                'rate_incall_2' => 54,
                'rate_outvall_2' => 2685,
                'rate_incall_3' => 81,
                'rate_outvall_3' => 3580,
                'rate_incall_6' => 116,
                'rate_outvall_6' => 5370,
                'rate_incall_12' => 179,
                'rate_outvall_12' => 8950,
                'rate_incall_24' => 224,
                'rate_outvall_24' => 16110,
                'rate_incall_48' => 268,
                'rate_outvall_48' => 26850,
                'rate_incall_24_second' => 134,
                'rate_outvall_24_second' => 13425,
                'timezone' => 'US/Hawaii',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        foreach ($escorts as $escort) {
            $escortBuilder = Escort::create($escort);
            $escortBuilder->languages()->sync([1, 2, 3]);
            $escortBuilder->blockCountries()->sync([1, 2, 3]);
        }
    }
}
