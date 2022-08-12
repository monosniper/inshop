<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'theme',
        'content',
        'answer',
    ];

    protected $casts = [
        'answered_at' => 'datetime'
    ];
}
