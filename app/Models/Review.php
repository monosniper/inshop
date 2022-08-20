<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_name',
        'author_url',
        'content',
        'rating',
        'shop_id',
        'date',
    ];

    public function shop() {
        return $this->belongsTo(Shop::class);
    }

    protected $casts = [
        'date' => 'datetime'
    ];
}
