<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Ajinkya Inchanalkar',
            'email' => 'ajinkya.inchanalkar@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin@123'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
