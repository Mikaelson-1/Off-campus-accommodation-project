<?php

namespace Database\Seeders;

use App\Models\Landlord;
use App\Models\Location;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        // Create 3 demo landlord users + profiles if they don't exist
        $landlords = [
            ['name' => 'Mr. Adeyemi Afolabi', 'email' => 'afolabi@demo.com'],
            ['name' => 'Mrs. Funke Owolabi',  'email' => 'funke@demo.com'],
            ['name' => 'Mr. Seun Bamidele',   'email' => 'seun@demo.com'],
        ];

        $landlordIds = [];
        foreach ($landlords as $landlordData) {
            $user = User::updateOrCreate(
                ['email' => $landlordData['email']],
                [
                    'name'     => $landlordData['name'],
                    'password' => Hash::make('password'),
                    'role'     => 'landlord',
                ]
            );
            $landlord = Landlord::updateOrCreate(
                ['user_id' => $user->id],
                ['verification_status' => 'verified']
            );
            $landlordIds[] = $landlord->id;
        }

        // Get all location IDs
        $locations = Location::all();

        $properties = [
            // Core Quarters Properties
            [
                'title'          => 'Akolade Villa',
                'description'    => 'Well-maintained self-contain rooms with steady electricity and water supply. Walking distance to BOUESTI main gate.',
                'type'           => 'self_contain',
                'address'        => '15 Uro Street, Ikere-Ekiti',
                'area'           => 'Uro',
                'distance_from_campus' => '3 min walk',
                'price_per_year' => 95000,
                'rooms_available'=> 5,
                'total_rooms'    => 8,
                'has_electricity'=> true,
                'has_water'      => true,
                'has_security'   => true,
                'is_furnished'   => false,
                'allows_cooking' => true,
                'status'         => 'approved',
                'location_name'  => 'Uro',
            ],
            [
                'title'          => 'Sunshine Lodge',
                'description'    => 'Affordable single rooms in a serene environment. Perfect for students on a budget.',
                'type'           => 'single_room',
                'address'        => '8 Odo Oja Road, Ikere-Ekiti',
                'area'           => 'Odo Oja',
                'distance_from_campus' => '5 min walk',
                'price_per_year' => 65000,
                'rooms_available'=> 7,
                'total_rooms'    => 12,
                'has_electricity'=> true,
                'has_water'      => true,
                'has_security'   => false,
                'is_furnished'   => false,
                'allows_cooking' => true,
                'status'         => 'approved',
                'location_name'  => 'Odo Oja',
            ],
            [
                'title'          => 'Divine Favour Hostel',
                'description'    => 'Modern mini-flats with attached kitchen and bathroom. Very secure and quiet environment.',
                'type'           => 'mini_flat',
                'address'        => '22 Oke\'Kere Avenue, Ikere-Ekiti',
                'area'           => 'Oke \'Kere',
                'distance_from_campus' => '7 min walk',
                'price_per_year' => 110000,
                'rooms_available'=> 3,
                'total_rooms'    => 6,
                'has_electricity'=> true,
                'has_water'      => true,
                'has_security'   => true,
                'is_furnished'   => true,
                'allows_cooking' => true,
                'status'         => 'approved',
                'location_name'  => 'Oke \'Kere',
            ],

            // Ward Properties
            [
                'title'          => 'Peace Haven',
                'description'    => 'Spacious single rooms with good ventilation. Peaceful neighborhood with friendly neighbors.',
                'type'           => 'single_room',
                'address'        => '4 Afao Street, Ikere-Ekiti',
                'area'           => 'Afao / Kajola',
                'distance_from_campus' => '10 min walk',
                'price_per_year' => 55000,
                'rooms_available'=> 10,
                'total_rooms'    => 15,
                'has_electricity'=> true,
                'has_water'      => true,
                'has_security'   => false,
                'is_furnished'   => false,
                'allows_cooking' => true,
                'status'         => 'approved',
                'location_name'  => 'Afao / Kajola',
            ],
            [
                'title'          => 'Testimony Lodge',
                'description'    => 'Clean self-contain rooms with constant water supply. Close to main market for easy shopping.',
                'type'           => 'self_contain',
                'address'        => '19 Are Street, Ikere-Ekiti',
                'area'           => 'Are / Araromi',
                'distance_from_campus' => '12 min walk',
                'price_per_year' => 80000,
                'rooms_available'=> 4,
                'total_rooms'    => 8,
                'has_electricity'=> true,
                'has_water'      => true,
                'has_security'   => true,
                'is_furnished'   => false,
                'allows_cooking' => true,
                'status'         => 'approved',
                'location_name'  => 'Are / Araromi',
            ],
            [
                'title'          => 'Royal Chambers',
                'description'    => 'Premium flats with modern amenities. Ideal for final year students who need extra comfort.',
                'type'           => 'flat',
                'address'        => '5 Atiba Road, Ikere-Ekiti',
                'area'           => 'Atiba / Aafin',
                'distance_from_campus' => '15 min walk',
                'price_per_year' => 150000,
                'rooms_available'=> 2,
                'total_rooms'    => 4,
                'has_electricity'=> true,
                'has_water'      => true,
                'has_security'   => true,
                'is_furnished'   => true,
                'allows_cooking' => true,
                'status'         => 'approved',
                'location_name'  => 'Atiba / Aafin',
            ],
            [
                'title'          => 'Grace Hostel',
                'description'    => 'Budget-friendly single rooms with shared facilities. Well-maintained and clean.',
                'type'           => 'single_room',
                'address'        => '31 Okeruku Street, Ikere-Ekiti',
                'area'           => 'Okeruku',
                'distance_from_campus' => '8 min walk',
                'price_per_year' => 50000,
                'rooms_available'=> 6,
                'total_rooms'    => 10,
                'has_electricity'=> true,
                'has_water'      => true,
                'has_security'   => false,
                'is_furnished'   => false,
                'allows_cooking' => true,
                'status'         => 'approved',
                'location_name'  => 'Okeruku',
            ],

            // Neighborhood Properties
            [
                'title'          => 'Olumilua Heights',
                'description'    => 'Modern self-contain rooms in a prime location. Very close to campus with excellent security.',
                'type'           => 'self_contain',
                'address'        => '2 Olumilua Area, Ikere-Ekiti',
                'area'           => 'Olumilua Area',
                'distance_from_campus' => '4 min walk',
                'price_per_year' => 100000,
                'rooms_available'=> 3,
                'total_rooms'    => 6,
                'has_electricity'=> true,
                'has_water'      => true,
                'has_security'   => true,
                'is_furnished'   => true,
                'allows_cooking' => true,
                'status'         => 'approved',
                'location_name'  => 'Olumilua Area',
            ],
            [
                'title'          => 'Comfort Zone Lodge',
                'description'    => 'Affordable mini-flats with attached kitchen and bathroom. Quiet environment for studying.',
                'type'           => 'mini_flat',
                'address'        => '14 Ajebandele, Ikere-Ekiti',
                'area'           => 'Ajebandele',
                'distance_from_campus' => '6 min walk',
                'price_per_year' => 90000,
                'rooms_available'=> 5,
                'total_rooms'    => 8,
                'has_electricity'=> true,
                'has_water'      => true,
                'has_security'   => true,
                'is_furnished'   => false,
                'allows_cooking' => true,
                'status'         => 'approved',
                'location_name'  => 'Ajebandele',
            ],
            [
                'title'          => 'Ikoyi Estate Hostel',
                'description'    => 'Premium duplex apartments with all modern amenities. The best accommodation for serious students.',
                'type'           => 'duplex',
                'address'        => '10 Ikoyi Estate, Ikere-Ekiti',
                'area'           => 'Ikoyi Estate',
                'distance_from_campus' => '10 min walk',
                'price_per_year' => 200000,
                'rooms_available'=> 2,
                'total_rooms'    => 4,
                'has_electricity'=> true,
                'has_water'      => true,
                'has_security'   => true,
                'is_furnished'   => true,
                'allows_cooking' => true,
                'status'         => 'approved',
                'location_name'  => 'Ikoyi Estate',
            ],
            [
                'title'          => 'Amoye Student Villa',
                'description'    => 'Self-contain rooms near Amoye Grammar School. Very affordable and close to school.',
                'type'           => 'self_contain',
                'address'        => '7 Amoye Grammar School Area, Ikere-Ekiti',
                'area'           => 'Amoye Grammar School Area',
                'distance_from_campus' => '5 min walk',
                'price_per_year' => 75000,
                'rooms_available'=> 8,
                'total_rooms'    => 12,
                'has_electricity'=> true,
                'has_water'      => true,
                'has_security'   => false,
                'is_furnished'   => false,
                'allows_cooking' => true,
                'status'         => 'approved',
                'location_name'  => 'Amoye Grammar School Area',
            ],
            [
                'title'          => 'Victory Lodge',
                'description'    => 'Clean single rooms with good ventilation. Close to transport terminal for easy movement.',
                'type'           => 'single_room',
                'address'        => '25 Uro Extension, Ikere-Ekiti',
                'area'           => 'Uro',
                'distance_from_campus' => '4 min walk',
                'price_per_year' => 60000,
                'rooms_available'=> 9,
                'total_rooms'    => 12,
                'has_electricity'=> true,
                'has_water'      => true,
                'has_security'   => false,
                'is_furnished'   => false,
                'allows_cooking' => true,
                'status'         => 'approved',
                'location_name'  => 'Uro',
            ],
        ];

        foreach ($properties as $propertyData) {
            $locationName = $propertyData['location_name'];
            unset($propertyData['location_name']);

            $location = $locations->firstWhere('name', $locationName);

            Property::updateOrCreate(
                ['title' => $propertyData['title']],
                array_merge($propertyData, [
                    'landlord_id' => $landlordIds[array_rand($landlordIds)],
                    'location_id' => $location?->id,
                    'approved_at' => now(),
                ])
            );
        }

        $this->command->info('✅ ' . count($properties) . ' demo properties seeded with location assignments.');
    }
}
