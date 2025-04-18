<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tabelnya tidak sesuai dengan nama model
    protected $table = 'laporans'; // Nama tabel di database (misalnya 'laporans')

    // Tentukan kolom yang dapat diisi
    protected $fillable = ['nama', 'lokasi', 'tanggal', 'kategori', 'status'];
}
