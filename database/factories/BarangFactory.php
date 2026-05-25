<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<Barang>
 */
class BarangFactory extends Factory
{
    public function definition(): array
    {
        return [
            'kode_barang' => 'BRG-' . strtoupper($this->faker->unique()->bothify('??###')),
            'qr_code' => null, // Dikosongkan sesuai permintaan
            'id_kategori' => Kategori::factory(), // Otomatis buat kategori baru jika tidak disertakan
            'nama_barang' => $this->faker->words(3, true),
            'harga' => $this->faker->numberBetween(1000, 500),
            'stok' => $this->faker->numberBetween(1, 100),
            'penyimpanan' => 'Gudang ' . $this->faker->randomElement(['A', 'B', 'C']) . ' Rak ' . $this->faker->numberBetween(1, 10),
            'specification' => [
                'warna' => $this->faker->safeColorName(),
                'berat' => $this->faker->numberBetween(100, 5000) . ' gram',
                'material' => $this->faker->randomElement(['Plastik', 'Kayu', 'Besi', 'Aluminium']),
                'dimensi' => '10x10x10 cm'
            ],
            'rating_avg' => null,
            'rating_count' => null,
            'status' => $this->faker->randomElement(['aktif', 'nonaktif', 'draft']),
        ];
    }
}
