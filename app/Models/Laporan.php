<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_laporan',
        'bukti_laporan',
        'lokasi_laporan',
        'ciri_khusus',
        'kategori_laporan',
        'deskripsi_laporan',
        'nomor_laporan',
    ];
}
