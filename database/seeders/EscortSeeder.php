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

        $escort = Escort::create([
            'agency_id'           => 1,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
        $escort->accountable()->create([
            'name'                 => 'Escort Account',
            'email'                => 'escort001@gmail.com',
            'password'             => \Hash::make('Escort@2022'),
        ]);
    }
}
