<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Field yang bisa diisi (mass assignment)
    protected $fillable = [
        'jenis_laporan',
        'bukti_laporan',
        'lokasi_laporan',
        'ciri_khusus',
        'kategori_laporan',
        'deskripsi_laporan',
        'nomor_laporan',
        'user_id', // Tambahkan ini kalau relasi ke user
    ];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke laporan_petugas berdasarkan laporan_id
    public function laporanPetugas()
    {
        return $this->hasMany(\App\Models\LaporanPetugas::class, 'laporan_id', 'id');
    }

    // Relasi ke feedback (hasOne)
    public function feedback()
    {
        return $this->hasOne(\App\Models\Feedback::class, 'laporan_id');
    }
}
