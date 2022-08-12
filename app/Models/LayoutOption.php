<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayoutOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'slug',
        'name',
        'description',
    ];

    public function parent() {
        return $this->belongsTo(LayoutOption::class, 'parent_id');
    }

//    public function getSlugAttribute() {
//        $parent = $this->parent;
//
//        if($parent) return $parent->slug.'.'.$this->slug;
//
//        return $this->slug;
//    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->parent ? $this->parent->slug.'.'.$value : $value,
        );
    }
}
