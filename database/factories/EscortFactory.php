<?php

namespace Database\Factories;

use App\Models\Escort;
use App\Models\EscortReview;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class EscortFactory extends Factory
{
    public function configure()
    {
        return $this->afterCreating(function (Escort $escort) {
            $account = $escort->accountable()->create([
                'name'        => $this->faker->name(),
                'email'       => $this->faker->email(),
                'is_verified' => 1,
                'password'    => Hash::make('123456789')
            ]);

            $escort->account_id = $account->id;
            $escort->save();

            $escort->languages()->sync([27, 44, 49, 66]);

            $escort->videoInfo()->create([
                'name'       => $this->faker->name(),
                'escort_id'  => $escort->id,
                'account_id' => $escort->accountable->id,
                'path'       => $this->faker->url(),
                'views'      => random_int(0, 10000),
                'type'       => 'mp4',
                'duration'   => random_int(10, 100),
            ]);

            $numberReview = random_int(1, 10);
            $numberTour = random_int(1, 10);

            EscortReview::factory($numberReview)->create([
                'escort_id' => $escort->id
            ]);

            Tour::factory($numberTour)->create([
                'escort_id' => $escort->id
            ]);

            $account->images()->create([
                'name'        => 'Escort image',
                'type'        => 'avatar',
                'path'        => $this->faker->imageUrl(
                    config('image.sizes.default.w'),
                    config('image.sizes.default.h'),
                ),
                'extension'   => 'png',
                'featured'    => 1,
                'size'        => random_int(100, 2000)
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
        $is_pornstar = [0, 1];
        $eye_colors = [ 'black', 'blue', 'blue-green', 'brown', 'green', 'grey', 'hazel'];
        $orientations = ['straight', 'bisexual', 'lesbian', 'homosexual'];
        $pubic_hairs = [ 'shaved', 'trimmed', 'natural'];

        $countries_ids = \DB::table('countries')->pluck('id')->toArray();
        $country_id    = $countries_ids[array_rand($countries_ids)];
        $cities_ids    = \DB::table('cities')->where('country_id', $country_id)->pluck('id')->toArray();
        $city_id       = !empty($cities_ids) ? $cities_ids[array_rand($cities_ids)] : null;

        return [
            'agency_id' => 1,
            'belong_escort_id' => null,
            'country_id' => $country_id,
            'city_id' => $city_id,
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
            'pornstar' => $this->rand_array($is_pornstar),
            'verify_text' => 'Verify text',
            'provides' => 'Provides',
            'meeting_with' => $this->rand_array($sexs),
            'website' => 'https://website.com',
            'phone1_code' => '84',
            'phone1' => $this->faker->phoneNumber(),
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
            'rate_incall_30' => random_int(100, 500),
            'rate_outvall_30' => random_int(100, 500),
            'rate_incall_1' => random_int(200, 600),
            'rate_outvall_1' => random_int(400, 1000),
            'rate_incall_2' => random_int(400, 2000),
            'rate_outvall_2' => random_int(400, 2000),
            'rate_incall_3' => random_int(400, 2000),
            'rate_outvall_3' => random_int(400, 2000),
            'rate_incall_6' => random_int(400, 5000),
            'rate_outvall_6' => random_int(400, 5000),
            'rate_incall_12' => random_int(1000, 8000),
            'rate_outvall_12' => random_int(1000, 8000),
            'rate_incall_24' => random_int(3000, 10000),
            'rate_outvall_24' => random_int(3000, 10000),
            'rate_incall_48' => random_int(3000, 15000),
            'rate_outvall_48' => random_int(3000, 20000),
            'rate_incall_24_second' => random_int(3000, 20000),
            'rate_outvall_24_second' => random_int(3000, 20000),
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
