<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';

    protected $fillable = [
        'user_id',
        'nomor_laporan',
        'judul',
        'deskripsi',
        'lokasi',
        'tanggal_kejadian',
        'foto',
        'status',
    ];

    protected $casts = [
        'tanggal_kejadian' => 'date',
        'foto' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function findByNomorLaporan(string $nomor): ?self
    {
        return self::where('nomor_laporan', $nomor)->first();
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'Diajukan' => 'bg-gray-100 text-gray-800',
            'Diproses' => 'bg-yellow-100 text-yellow-800',
            'Ditindaklanjuti' => 'bg-blue-100 text-blue-800',
            'Selesai' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'Diajukan' => 'Laporan Diterima',
            'Diproses' => 'Proses Verifikasi',
            'Ditindaklanjuti' => 'Proses Tindak Lanjut',
            'Selesai' => 'Selesai',
            default => 'Tidak Diketahui',
        };
    }
}