<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserLaporanController extends Controller
{
    public function ringkasan()
    {
        // Ambil data status laporan
        $statusCounts = DB::table('laporans')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // Ambil kategori/jenis kerusakan
        $kategoriCounts = DB::table('laporans')
            ->select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->get();

        // Ambil kondisi lapangan dari tabel laporan_petugas
        $kondisiCounts = DB::table('laporan_petugas')
            ->select('kondisi_lapangan', DB::raw('count(*) as total'))
            ->groupBy('kondisi_lapangan')
            ->get();

        return view('user.ringkasanlaporan', compact('statusCounts', 'kategoriCounts', 'kondisiCounts'));
    }
}
