<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EditorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('editors')->insert([
            'name' => 'New Editor',
            'email' => 'editor@material.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
