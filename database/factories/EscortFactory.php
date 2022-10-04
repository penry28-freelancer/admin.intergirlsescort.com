<?php

namespace Database\Factories;

use App\Models\Escort;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class EscortFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function configure()
    {
        return $this->afterCreating(function (Escort $escort) { 
            $escort->accountable()->create([
                'name'      => $this->faker->name(),
                'email'     => $this->faker->email(),
                'password'  => Hash::make('Escort@2022')
            ]);
        });
    }
    
    public function definition()
    {
        $sexs = ['woman', 'man', 'trans', 'duo', 'couple'];
        $ethnicities = ['arabian', 'asian', 'ebony', 'european', 'indian', 'latin', 'mongolia', 'mixed'];
        $hair_colors = ['blonde', 'brown', 'black', 'red'];
        $hair_lengths = ['short', 'medium-long', 'long'];
        $bust_sizes = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
        $bust_types = ['natural', 'silicon'];
        $available_fors = ['outcall', 'incall', 'outcall-incall'];
        $travels = ['no', 'countrywide', 'europe', 'worldwide'];
        $tattoos = ['yes', 'no'];
        $piercings = ['yes', 'no'];
        $smokers = ['yes', 'no'];
        $is_pornstar = ['yes', 'no'];
        $eye_colors = [ 'black', 'blue', 'blue-green', 'brown', 'green', 'grey', 'hazel'];
        $orientations = ['straight', 'bisexual', 'lesbian', 'homosexual'];
        $pubic_hairs = [ 'shaved', 'trimmed', 'natural'];

        return [
            'agency_id' => 1,
            'belong_escort_id' => null,
            'country_id' => random_int(1, 110),
            'city_id' => random_int(1, 1630),
            'perex' => 'Perex',
            'sex' => $sexs[array_rand($sexs)],
            'birt_year' => random_int(1950, 2004),
            'height' => random_int(130, 200),
            'weight' => random_int(30, 150),
            'ethnicity' => $this->rand_array($ethnicities),
            'hair_color' => $this->rand_array($hair_colors),
            'hair_lenght' => $this->rand_array($hair_lengths),
            'bust_size' =>  $this->rand_array($bust_sizes),
            'bust_type' => $this->rand_array($bust_types),
            'provides1' => $this->rand_array($available_fors),
            'nationality_counter_id' => random_int(1, 110),
            'travel' => $this->rand_array($travels),
            'tattoo' => $this->rand_array($tattoos),
            'piercing' => $this->rand_array($piercings),
            'smoker' => $this->rand_array($smokers),
            'eye' => $this->rand_array($eye_colors),
            'orientation' => $this->rand_array($orientations),
            'hair_pubic' => $this->rand_array($pubic_hairs),
            'pornstar' => 1,
            'verify_text' => 'Verify text',
            'provides' => 'Provides',
            'meeting_with' => $this->rand_array($sexs),
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
        ];
    }

    public function rand_array($array)
    {
        return $array[array_rand($array)];
    }
}
