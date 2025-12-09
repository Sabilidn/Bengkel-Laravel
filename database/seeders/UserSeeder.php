<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => 1
            ],
            [
                'name' => 'Pemilik',
                'email' => 'Pemilik@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => 0
            ]
        ]);
    }
}
