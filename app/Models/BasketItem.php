<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'basket_id',
        'product_id',
        'count',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function basket() {
        return $this->belongsTo(Basket::class);
    }
}
