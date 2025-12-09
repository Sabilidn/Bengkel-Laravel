<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    public function definition(): array
    {
        $names = [
            'Ahmad Firdaus',
            'Siti Nurhaliza',
            'Budi Santoso',
            'Linda Kusuma',
            'Rizky Hidayat',
            'Dewi Ayu',
            'Andi Pratama',
            'Nur Aini',
            'Fajar Ramadhan',
            'Melati Putri',
        ];

        $jenisKendaraan = [
            'Toyota',
            'Honda',
            'Suzuki',
            'Daihatsu',
            'Mitsubishi',
            'Nissan',
            'Hyundai',
            'Wuling',
            'Kia',
            'Mazda'
        ];

        // Plat nomor khusus Jambi (kode: BH)
        $angka = $this->faker->numberBetween(1000, 9999); // 4 digit angka
        $hurufAkhir = strtoupper($this->faker->randomLetter() . $this->faker->randomLetter());

        return [
            'nama' => $this->faker->unique()->randomElement($names),
            'nomor_handphone' => '08' . $this->faker->numberBetween(11, 99) . $this->faker->numerify('########'),
            'plat_nomor' => "BH {$angka} {$hurufAkhir}",
            'jenis_kendaraan' => $this->faker->randomElement($jenisKendaraan),
        ];
    }
}
