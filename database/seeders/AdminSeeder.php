<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@laporpak.com',
            'password' => Hash::make('admin123'), // Ganti password sesuai keinginan
            'role' => 'admin',
        ]);
    }
}
