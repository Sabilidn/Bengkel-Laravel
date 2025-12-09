<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $categories = [
            ['nama' => 'Oli Mesin'],
            ['nama' => 'Ban'],
            ['nama' => 'Aki'],
            ['nama' => 'Filter Udara'],
            ['nama' => 'Kampas Rem'],
            ['nama' => 'Busi'],
            ['nama' => 'Lampu'],
            ['nama' => 'Tune Up'],
        ];

        DB::table('categories')->insert($categories);
    }
}
