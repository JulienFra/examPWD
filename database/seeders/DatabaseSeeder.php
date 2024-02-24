<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'Thibault Six',
            'email' => 'tsix@example.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Sandrine',
            'email' => 'sandrine@example.com',
        ]);
    }
}
