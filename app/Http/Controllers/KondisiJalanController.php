<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class KondisiJalanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::whereNotNull('lokasi')->get();

        $data = $laporans->map(function ($laporan) {
            return [
                'lokasi' => $laporan->lokasi, // format: "latitude,longitude"
                'status' => $laporan->status,
                'kategori' => $laporan->kategori,
            ];
        });

        return view('petakondisi.index', compact('data'));
    }
}
