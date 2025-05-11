<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'status' // 1 for active, 0 for inactive
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}