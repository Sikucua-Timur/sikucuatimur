<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat Superadmin default
        User::updateOrCreate(
            ['email' => 'superadmin@sikucuatimur.id'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('5ikucuat1mur.1'),
                'role' => 'superadmin'
            ]
        );
    }
}
