<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'client_id',
    ];

    static public function findByShopClient($shop_id, $client_id) {
        return Basket::where([
            ['shop_id', $shop_id],
            ['client_id', $client_id],
        ])->first();
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function shop() {
        return $this->belongsTo(Shop::class);
    }

    public function items() {
        return $this->hasMany(BasketItem::class);
    }
}
