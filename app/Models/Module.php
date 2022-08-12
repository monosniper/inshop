<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'price',
    ];

    public function dependencies() {
        return $this->belongsToMany(Module::class, 'module_dependency', 'dependency_id');
    }

    public function revertDependencies() {
        return Module::whereRelation('dependencies', 'module_id', $this->id)->get();
    }
}
