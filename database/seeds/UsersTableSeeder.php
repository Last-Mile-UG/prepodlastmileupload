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
            'name' => 'Admin',
            'email' => 'admin@nowui.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('users')->insert([
            'name' => 'Vendor',
            'email' => 'vendor@vendor.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'vendor',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
