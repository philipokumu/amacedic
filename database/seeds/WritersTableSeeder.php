<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class WritersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('writers')->insert([
            'name' => 'New Writer',
            'email' => 'writer@material.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
