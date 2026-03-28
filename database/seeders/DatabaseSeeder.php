<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed locations first (required for property assignments)
        $this->call(LocationSeeder::class);

        // Seed demo properties with location assignments
        $this->call(PropertySeeder::class);

        $this->command->info(' All seeders completed successfully.');
    }
}
