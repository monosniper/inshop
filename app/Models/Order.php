<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $with = ['products'];

    protected $fillable = [
        'shop_id',
        'shipping_data',
        'payed',
        'billId',
    ];

    protected $casts = [
        'shipping_data' => 'array',
        'payed' => 'boolean',
    ];

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
