<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    
    protected $fillable = [
        'judul',
        'kategori',
        'isi',
        'tanggal_terbit',
        'gambar',
        'status'
    ];

    protected $casts = [
        'tanggal_terbit' => 'date'
    ];
}
