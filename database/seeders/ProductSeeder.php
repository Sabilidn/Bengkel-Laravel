<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID semua kategori dari tabel categories
        $categories = DB::table('categories')->pluck('id', 'nama');

        // 20 Produk dikelompokkan sesuai kategori
        $products = [
            'Oli Mesin' => [
                ['nama' => 'Oli Mobil Shell Helix HX7 4L', 'harga' => 320000, 'stok' => 25],
                ['nama' => 'Oli Castrol GTX 10W-40 4L', 'harga' => 340000, 'stok' => 20],
                ['nama' => 'Oli Toyota Genuine Oil 4L', 'harga' => 310000, 'stok' => 30],
            ],
            'Ban' => [
                ['nama' => 'Ban Bridgestone Turanza 195/65 R15', 'harga' => 750000, 'stok' => 20],
                ['nama' => 'Ban Dunlop SP Sport 185/70 R14', 'harga' => 700000, 'stok' => 15],
                ['nama' => 'Ban GT Radial Champiro 185/65 R15', 'harga' => 680000, 'stok' => 18],
            ],
            'Aki' => [
                ['nama' => 'Aki GS Astra MF NS40Z', 'harga' => 850000, 'stok' => 15],
                ['nama' => 'Aki Yuasa NS60LS', 'harga' => 830000, 'stok' => 10],
            ],
            'Filter' => [
                ['nama' => 'Filter Udara Avanza/Xenia', 'harga' => 70000, 'stok' => 25],
                ['nama' => 'Filter Oli Mobil Toyota', 'harga' => 65000, 'stok' => 30],
                ['nama' => 'Filter Kabin Honda Mobilio', 'harga' => 80000, 'stok' => 20],
            ],
            'Kampas Rem' => [
                ['nama' => 'Kampas Rem Depan Toyota Calya', 'harga' => 150000, 'stok' => 25],
                ['nama' => 'Kampas Rem Belakang Honda Jazz', 'harga' => 140000, 'stok' => 20],
            ],
            'Busi' => [
                ['nama' => 'Busi NGK BKR6E-11', 'harga' => 45000, 'stok' => 40],
                ['nama' => 'Busi Denso K20PR-U11', 'harga' => 42000, 'stok' => 35],
            ],
            'Lampu' => [
                ['nama' => 'Lampu Depan H4 Philips 12V 60/55W', 'harga' => 90000, 'stok' => 30],
                ['nama' => 'Lampu Rem LED Mobil T10', 'harga' => 35000, 'stok' => 40],
                ['nama' => 'Lampu Sein Mobil Avanza', 'harga' => 25000, 'stok' => 35],
            ],
        ];


        foreach ($products as $categoryName => $items) {
            $categoryId = $categories[$categoryName] ?? null;

            if ($categoryId) {
                foreach ($items as $product) {
                    DB::table('products')->insert([
                        'nama' => $product['nama'],
                        'id_category' => $categoryId,
                        'harga' => $product['harga'],
                        'stok' => $product['stok'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
