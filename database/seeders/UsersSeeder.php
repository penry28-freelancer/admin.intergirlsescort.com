<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    const PASSWORD_SUPER_ADMIN = 'Admin@2022';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('users')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \DB::table('users')->insert([
            [
                'name'       => 'Administrator',
                'email'      => 'administrator@gmail.com',
                'password'   => \Hash::make(self::PASSWORD_SUPER_ADMIN),
                'active'     => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
