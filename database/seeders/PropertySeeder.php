<?php

namespace Database\Seeders;

use App\Models\Landlord;
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

        $properties = [
            [
                'title'          => 'Grace Court Hostel',
                'description'    => 'A clean and well-maintained hostel with constant water supply and 24/7 security. Close to BOUESTI campus gate.',
                'type'           => 'self_contain',
                'address'        => '12 Afon Lodge Road, Ikere-Ekiti',
                'area'           => 'Afon Lodge area',
                'price_per_year' => 85000,
                'rooms_available'=> 4,
                'total_rooms'    => 6,
                'has_electricity'=> true,
                'has_water'      => true,
                'has_security'   => true,
                'is_furnished'   => false,
                'allows_cooking' => true,
                'status'         => 'approved',
            ],
            [
                'title'          => 'Sunshine Students Lodge',
                'description'    => 'Spacious rooms with good ventilation, located centrally near Odo-Oja market. Convenient for all students.',
                'type'           => 'single_room',
                'address'        => '7B Odo-Oja Street, Ikere-Ekiti',
                'area'           => 'Odo-Oja',
                'price_per_year' => 60000,
                'rooms_available'=> 8,
                'total_rooms'    => 10,
                'has_electricity'=> true,
                'has_water'      => true,
                'has_security'   => false,
                'is_furnished'   => false,
                'allows_cooking' => true,
                'status'         => 'approved',
            ],
            [
                'title'          => 'Temidire Mini Flats',
                'description'    => 'Modern self-contained mini-flats in a quiet, secure estate environment. Ideal for serious students.',
                'type'           => 'mini_flat',
                'address'        => '3 Temidire Estate, Ikere-Ekiti',
                'area'           => 'Temidire',
                'price_per_year' => 120000,
                'rooms_available'=> 2,
                'total_rooms'    => 4,
                'has_electricity'=> true,
                'has_water'      => true,
                'has_security'   => true,
                'is_furnished'   => true,
                'allows_cooking' => true,
                'status'         => 'approved',
            ],
        ];

        foreach ($landlords as $index => $landlordData) {
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

            Property::updateOrCreate(
                ['title' => $properties[$index]['title']],
                array_merge($properties[$index], [
                    'landlord_id' => $landlord->id,
                    'approved_at' => now(),
                ])
            );
        }

        $this->command->info('✅ 3 demo properties seeded.');
    }
}
