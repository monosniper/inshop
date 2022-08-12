<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'domain_id',
        'options'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    static public function findByDomain($domain_id) {
        return Shop::where('domain_id', $domain_id)->first();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function hasModule($module_id) {
        return in_array($module_id, (array)$this->modules->pluck('id'));
    }

    public function modules(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Module::class)
            ->withPivot('isActive');
    }

    public function layoutOptions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(LayoutOption::class, 'shop_layout_option')
            ->withPivot('isActive');
    }

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function clients(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function baskets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Basket::class);
    }

    public function getFullDomain(): string
    {
        $domain = $this->domain;

        return $domain ? $domain->name . '.' . config('app.shops_domain') : '';
    }
}
