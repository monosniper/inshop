<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug'
    ];

    public function getIconUrl() {
        return asset('assets/img/social/'.$this->slug.'.svg');
    }
}
