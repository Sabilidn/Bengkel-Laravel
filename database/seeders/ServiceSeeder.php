<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'nama' => 'Ganti Oli Mesin',
                'harga' => '150000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Servis Rem Depan & Belakang',
                'harga' => '200000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Spooring & Balancing',
                'harga' => '250000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Cuci Mobil Lengkap (Luar & Dalam)',
                'harga' => '50000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Tune Up Mesin',
                'harga' => '300000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Penggantian Aki Mobil',
                'harga' => '400000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Flushing Radiator',
                'harga' => '180000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Servis AC Mobil',
                'harga' => '350000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Pembersihan Throttle Body',
                'harga' => '120000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Pemeriksaan Kelistrikan',
                'harga' => '100000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
