<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CustomPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'title',
        'description',
        'content',
        'isActive',
        'slug',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($page) {
            $page->slug = Str::slug($page->title);
            $page->saveQuietly();
        });

        static::updated(function ($page) {
            $page->slug = Str::slug($page->title);
            $page->saveQuietly();
        });
    }
}
