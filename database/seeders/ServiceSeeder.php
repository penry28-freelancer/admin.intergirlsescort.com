<?php

namespace Database\Seeders;

use Carbon\Carbon;

class ServiceSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('services')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $services = [
            '69 position',
            'Anal',
            'Bondage',
            'Casual photos',
            'Classic sex',
            'Couples',
            'Cum in face',
            'Cum in mouth',
            'Cum on body',
            'Cunnilingus',
            'Deepthroat',
            'Dirty talk',
            'Domination',
            'Duo with girl',
            'Erotic massage',
            'Erotic Photos',
            'Fingering',
            'Foot fetish',
            'French kissing',
            'GFE',
            'Golden shower give',
            'Golden shower receive',
            'Group sex',
            'Handjob',
            'Kamasutra',
            'Masturbation',
            'Mistress',
            'Oral without condom',
            'Porn Star Experience',
            'Prostate massage',
            'Rimming active',
            'Rimming passive',
            'Role-play',
            'Sex between breasts',
            'Sex Toys',
            'Squirting',
            'Strapon service',
            'Striptease',
            'Submissive',
            'Swallowing',
            'Uniforms',
            'Video with sex',
            'With 2 men',
        ];

        foreach ($services as $service) {
            \DB::table('services')->insert([
                'name' => $service,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
