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
        'isSubdomain',
    ];

    public function getFullDomain(): string
    {
        return $this->isSubdomain ? $this->name . '.' . config('app.shops_domain') : $this->name;
    }

    public function shop() {
        return $this->hasOne(Shop::class);
    }
}
