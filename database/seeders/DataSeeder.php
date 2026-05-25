<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Kategori::factory(5)->create();

        Barang::factory(20)->create([
            'id_kategori' => $categories->random()->id_kategori
        ]);
    }
}
