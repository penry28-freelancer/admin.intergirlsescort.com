<?php

namespace Database\Seeders;

use Carbon\Carbon;

class AdvertiseSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('advertises')->truncate();
        \DB::table('images')->where('imageable_type', '\App\Models\Advertise')->delete();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $demo_dir = public_path('images/demo/banner-advertise/');

        $advertises = [
            [
                'data' => [
                    'link1' => '<a href="https://www.eurogirlsescort.com" target="_blank" title="EuroGirlsEscort.com"><img src="https://www.eurogirlsescort.com/dist/images/banners/468X60.jpg" alt="EuroGirlsEscort.com" title="EuroGirlsEscort.com"></a>',
                    'order' => 1,
                ]
            ],
            [
                'banner' => '1.png',
                'data'   => [
                    'link1'  => '<a href="https://www.eurogirlsescort.com" target="_blank" title="EuroGirlsEscort.com"><img src="https://www.eurogirlsescort.com/dist/images/banners/234X60.jpg" alt="EuroGirlsEscort.com" title="EuroGirlsEscort.com"></a>',
                    'order'  => 2,
                ]
            ],
            [
                'banner' => '2.png',
                'data'   => [
                    'link1'  => '<a href="https://www.eurogirlsescort.com" target="_blank" title="EuroGirlsEscort.com"><img src="https://www.eurogirlsescort.com/dist/images/banners/300X100.jpg" alt="EuroGirlsEscort.com" title="EuroGirlsEscort.com"></a>',
                    'link2'  => '<a href="https://www.eurogirlsescort.com" target="_blank" title="EuroGirlsEscort.com"><img src="https://www.eurogirlsescort.com/dist/images/banners/728X90.jpg" alt="EuroGirlsEscort.com" title="EuroGirlsEscort.com"></a>',
                    'link3'  => '<a href="https://www.eurogirlsescort.com" target="_blank" title="EuroGirlsEscort.com"><img src="https://www.eurogirlsescort.com/dist/images/banners/120X240.jpg" alt="EuroGirlsEscort.com" title="EuroGirlsEscort.com"></a>',
                    'order'  => 4,
                ]
            ],
            [
                'banner' => '3.png',
                'data'   => [
                    'link1'  => '<a href="https://www.eurogirlsescort.com" target="_blank" title="EuroGirlsEscort.com"><img src="https://www.eurogirlsescort.com/dist/images/banners/96X60.jpg" alt="EuroGirlsEscort.com" title="EuroGirlsEscort.com"></a>',
                    'order'  => 5,
                ]
            ],
            [
                'banner' => '4.png',
                'data'   => [
                    'link1'  => '<a href="https://www.eurogirlsescort.com" target="_blank" title="EuroGirlsEscort.com"><img src="https://www.eurogirlsescort.com/dist/images/banners/120X60.jpg" alt="EuroGirlsEscort.com" title="EuroGirlsEscort.com"></a>',
                    'order'  => 6,
                ]
            ]
        ];

        foreach ($advertises as $advertise) {
            $resource = $advertise['data'];
            $resource['created_at'] = Carbon::now();
            $resource['updated_at'] = Carbon::now();

            $advertiseBuilder = \App\Models\Advertise::create($resource);
            if (empty($advertise['banner'])) continue;

            $file = $demo_dir . $advertise['banner'];

            if (! file_exists($file)) continue;

            $folder_name = 'advertise';
            $image_ext   = pathinfo($file, PATHINFO_EXTENSION);
            $image_name  = \Str::random(10) . '.' . $image_ext;

            $target_file = $this->__dir . DIRECTORY_SEPARATOR . $folder_name . DIRECTORY_SEPARATOR . $image_name;

            if ($this->__disk->put($target_file, file_get_contents($file))) {
                \DB::table('images')->insert([
                    'name'           => $image_name,
                    'path'           => $target_file,
                    'extension'      => $image_ext,
                    'type'           => 'banner',
                    'size'           => filesize($file),
                    'imageable_id'   => $advertiseBuilder->id,
                    'imageable_type' => '\App\Models\Advertise',
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now(),
                ]);
            }
        }
    }
}
