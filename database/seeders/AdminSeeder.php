<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            [
                'email' => 'admin@laporpak.com',
            ],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'), // Ganti password sesuai keinginan
                'role' => 'admin',
            ]
        );
    }
}
