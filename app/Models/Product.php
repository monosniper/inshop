<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'price',
        'inStock',
        'properties',
        'description',
        'shop_id',
        'category_id',
        'uuid',
    ];

    public function shop() {
        return $this->belongsTo(Shop::class);
    }

    public function category() {
        return $this->shop->categories->where('id', $this->category_id)->first();
    }

    public function getImages() {
        $filenames = Storage::disk('public')->files($this->uuid . '/images');

        return count($filenames) ? array_map(function ($image) {
            return Storage::disk('public')->url($image);
        }, $filenames) : [asset('assets/img/default/product.jpg')];
    }

    public function getPreviewUrl(): string
    {
        $filenames = Storage::disk('public')->files($this->uuid . '/images');

        return count($filenames) ? Storage::disk('public')->url($filenames[0]) : asset('assets/img/default/product.jpg');
    }
}
