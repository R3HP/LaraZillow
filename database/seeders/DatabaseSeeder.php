<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => true,
            'password' => 'password'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User2',
            'email' => 'test2@example.com',
            'password' => 'password'
        ]);

        Listing::factory(10)->create([
            'owner_id' => 1
        ]);
        Listing::factory(20)->create([
            'owner_id' => 2
        ]);
    }
}
