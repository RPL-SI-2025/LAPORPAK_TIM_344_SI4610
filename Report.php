<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    protected $fillable = [
        'nomor_laporan',
        'judul',
        'deskripsi',
        'status',
    ];

    public static function findByNomorLaporan(string $nomor): ?self
    {
        return self::where('nomor_laporan', $nomor)->first();
    }
}
