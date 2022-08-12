<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'shop_id',
        'uuid',
    ];

    public function shop() {
        return $this->belongsTo(Shop::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function getProductsCount() {
        return count($this->products);
    }

    public function getIconUrl() {
        $filenames = Storage::disk('public')->files($this->uuid . '/icon');

        return count($filenames) ? array_map(function ($image) {
            return Storage::disk('public')->url($image);
        }, $filenames)[0] : asset('assets/img/default/category.png');
    }
}
