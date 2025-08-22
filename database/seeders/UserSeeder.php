<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sikucurtimur.id'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('5ikucuat1mur.1'),
                'role'     => 'superadmin',
            ]
        );
    }
}
