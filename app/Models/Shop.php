<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'domain_id',
        'options'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    static public function findByDomain($domain_id) {
        return Shop::where('domain_id', $domain_id)->first();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function banners(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Banner::class);
    }

    public function hasModule($module_id): bool
    {
        return in_array($module_id, (array)$this->modules->pluck('id'));
    }

    public function customPages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CustomPage::class);
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

    public function filters(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ShopFilter::class, 'shop_shop_filter')
            ->withPivot('isActive');
    }

    public function socialNetworks(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(SocialNetwork::class, 'shop_social_network')
            ->withPivot('value');
    }

    public function colors(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'shop_color')
            ->withPivot('value');
    }

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
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

    public function getLogoUrl() {
        $filenames = Storage::disk('public')->files($this->uuid . '/images');

        return count($filenames) ? array_map(function ($image) {
            return Storage::disk('public')->url($image);
        }, $filenames)[0] : asset('assets/img/default/logo.png');
    }

    public function getLogoName() {
        $file = Storage::disk('public')->files($this->uuid . '/images');
        $name = explode('/', count($file) ? $file[0] : asset('assets/img/default/logo.png'));
        return $name[count($name) - 1];
    }
}
