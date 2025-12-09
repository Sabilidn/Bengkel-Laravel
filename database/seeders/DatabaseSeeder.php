<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Member;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            Member::factory()->count(10)->create();
       $this->call([
        UserSeeder::class,
        CategorySeeder::class,
        ProductSeeder::class,
        ServiceSeeder::class
       ]);
    }
}
