<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporans = [
            ['id' => 1, 'user_id' => 1, 'jenis_laporan' => 'Privat', 'bukti_laporan' => 'laporan1.jpg', 'lokasi' => 'Jl. Imam Bonjol', 'ciri_khusus' => 'Jalan berlubang', 'kategori' => 'Jalan Rusak', 'deskripsi' => 'Jalan berlubang dan tidak aman untuk dikendarai', 'nomor_laporan' => 'LPR-001'],
        ];

        foreach ($laporans as $laporan) {
            \App\Models\Laporan::create($laporan);
        }
    }
}
