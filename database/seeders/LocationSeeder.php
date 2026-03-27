<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            // Core Quarters
            ['name' => 'Uro', 'classification' => 'core_quarter'],
            ['name' => 'Odo Oja', 'classification' => 'core_quarter'],
            ['name' => 'Oke \'Kere', 'classification' => 'core_quarter'],

            // Wards
            ['name' => 'Afao / Kajola', 'classification' => 'ward'],
            ['name' => 'Are / Araromi', 'classification' => 'ward'],
            ['name' => 'Atiba / Aafin', 'classification' => 'ward'],
            ['name' => 'Okeruku', 'classification' => 'ward'],

            // Neighborhoods/Landmarks
            ['name' => 'Olumilua Area', 'classification' => 'neighborhood'],
            ['name' => 'Ajebandele', 'classification' => 'neighborhood'],
            ['name' => 'Ikoyi Estate', 'classification' => 'neighborhood'],
            ['name' => 'Amoye Grammar School Area', 'classification' => 'neighborhood'],
        ];

        foreach ($locations as $location) {
            Location::updateOrCreate(
                ['name' => $location['name']],
                $location
            );
        }

        $this->command->info('Locations seeded successfully: ' . count($locations) . ' locations created.');
    }
}
