<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('contacts')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $contacts = [
            [
                'name'    => 'Denis',
                'email'   => 'denis@gmail.com',
                'message' => 'Contact Denis',
            ],
            [
                'name'    => 'Howard',
                'email'   => 'howard@gmail.com',
                'message' => 'Contact Howard',
            ],
            [
                'name'    => 'Tobin',
                'email'   => 'tobin@gmail.com',
                'message' => 'Contact Tobin',
            ],
        ];

        foreach ($contacts as $contact) {
            \DB::table('contacts')->insert([
                'name'       => $contact['name'],
                'email'      => $contact['email'],
                'message'    => $contact['message'],
                'read_at'    => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
