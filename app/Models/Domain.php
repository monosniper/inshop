<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'user_id',
    ];

    public function getFullDomain(): string
    {
        return $this->name . '.' . config('app.shops_domain');
    }

    public function shop() {
        return $this->hasOne(Shop::class);
    }
}
