<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'laporan_id',
        'rating',
        'kategori',
        'pesan',
        'saran',
    ];

    /**
     * Get the user that owns the feedback.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the laporan that owns the feedback.
     */
    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }
}
