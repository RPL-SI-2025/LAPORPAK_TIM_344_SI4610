<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        // Create a user first
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);

        // Create reports with different statuses
        Report::factory()->create([
            'user_id' => $user->id,
            'nomor_laporan' => 'LAP123456',
            'judul' => 'Laporan Test 1',
            'status' => 'Diajukan'
        ]);

        Report::factory()->create([
            'user_id' => $user->id,
            'nomor_laporan' => 'LAP234567',
            'judul' => 'Laporan Test 2',
            'status' => 'Diproses'
        ]);

        Report::factory()->create([
            'user_id' => $user->id,
            'nomor_laporan' => 'LAP345678',
            'judul' => 'Laporan Test 3',
            'status' => 'Ditindaklanjuti'
        ]);

        Report::factory()->create([
            'user_id' => $user->id,
            'nomor_laporan' => 'LAP456789',
            'judul' => 'Laporan Test 4',
            'status' => 'Ditanggapi'
        ]);

        Report::factory()->create([
            'user_id' => $user->id,
            'nomor_laporan' => 'LAP567890',
            'judul' => 'Laporan Test 5',
            'status' => 'Selesai'
        ]);
    }
}
