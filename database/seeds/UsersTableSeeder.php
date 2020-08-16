<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'New Client',
            'email' => 'client@material.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'referralId' => '79e4155a-fa7a-454f-8aba-a82bfc2c5eb3',
            'visitor' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
