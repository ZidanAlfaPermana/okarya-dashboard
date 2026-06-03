<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'mamageh12@gmail.com',
            'password' => bcrypt('mamageh12'),
            'level' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'mamageh13@gmail.com',
            'password' => bcrypt('mamageh13'),
            'level' => 'user',
        ]);
    }
}
