<?php

namespace Database\Factories;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<Kategori>
 */
class KategoriFactory extends Factory
{
    public function definition(): array
    {
        $daftarKategori = [
            'Elektronik', 'Perabotan', 'Alat Tulis', 'Pakaian',
            'Otomotif', 'Kesehatan', 'Hobi', 'Olahraga', 'Makanan'
        ];

        return [
            'nama_kategori' => $this->faker->unique()->randomElement($daftarKategori),
            'deskripsi' => $this->faker->sentence(10),
            'status' => $this->faker->randomElement(['aktif', 'nonaktif', 'draft']),
        ];
    }
}
