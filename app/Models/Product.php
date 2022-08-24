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
        'discount',
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
        return $this->category_id && $this->shop ? $this->shop->categories->where('id', $this->category_id)->first() : null;
    }

    public function getImages() {
        $filenames = Storage::disk('public')->files($this->uuid . '/images');

        return count($filenames) ? array_map(function ($image) {
            return Storage::disk('public')->url($image);
        }, $filenames) : [asset('assets/img/default/product.jpg')];
    }

    public function getImagesNames() {
        $filenames = Storage::disk('public')->files($this->uuid . '/images');

        return array_map(function($image) {
            $_image = explode('/', $image);
            return $_image[count($_image) - 1];
        }, $filenames);
    }

    public function getPreviewUrl(): string
    {
        $filenames = Storage::disk('public')->files($this->uuid . '/images');

        return count($filenames) ? Storage::disk('public')->url($filenames[0]) : asset('assets/img/default/product.jpg');
    }
}
