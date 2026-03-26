<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed a default admin account for BOUESTI.
     * Change the email/password before going to production!
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@bouesti.edu.ng'],
            [
                'name'     => 'BOUESTI Admin',
                'password' => Hash::make('Admin@1234'),
                'role'     => 'admin',
                'phone'    => null,
            ]
        );

        $this->command->info('✅ Admin account seeded: admin@bouesti.edu.ng / Admin@1234');
    }
}
