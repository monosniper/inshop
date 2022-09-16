<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Color;
use App\Models\LayoutOption;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ShopFilter;
use App\Models\SocialNetwork;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class ShopObserver
{
    public function createStartCategories($shop) {
        $categories_count = 3;
        $categories = [];

        $category_data = [
            'ru' => [
                'title' => function($i) {
                    return "Категория #$i";
                },
            ],
            'en' => [
                'title' => function($i) {
                    return "Category #$i";
                },
            ],
        ];

        for($i=1;$i<=$categories_count;$i++) {
            $data = $category_data[$shop->options['language']];
            $uuid = Uuid::uuid4()->toString();
            $categories[] = new Category([
                'title' => $data['title']($i),
                'uuid' => $uuid,
            ]);

            Storage::disk('public')->putFile($uuid . '/images', new File(public_path('assets/img/default/category.png')));
        }

        $shop->categories()->saveMany($categories);

        return $categories;
    }

    public function createStartProducts($shop, $categories) {
        $products_count = 3;
        $products = [];

        $product_data = [
            'ru' => [
                'title' => function($i) {
                    return "Новый товар #$i";
                },
                'subtitle' => 'Это отличный товар!',
                'description' => 'Таким образом постоянное информационно-пропагандистское обеспечение нашей деятельности в значительной степени обуславливает создание новых предложений. Значимость этих проблем настолько очевидна, что сложившаяся структура организации позволяет оценить значение соответствующий условий активизации. ',
            ],
            'en' => [
                'title' => function($i) {
                    return "New product #$i";
                },
                'subtitle' => 'This is an awesome product!',
                'description' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.',
            ]
        ];

        for($i=1;$i<=$products_count;$i++) {
            $data = $product_data[$shop->options['language']];
            $uuid = Uuid::uuid4()->toString();
            $products[] = new Product([
                'title' => $data['title']($i),
                'subtitle' => $data['subtitle'],
                'description' => $data['description'],
                'price' => 49.99,
                'inStock' => 100,
                'category_id' => $categories[0]->id,
                'uuid' => $uuid,
            ]);

            Storage::disk('public')->putFile($uuid . '/images', new File(public_path('assets/img/default/product.jpg')));
        }

        $shop->products()->saveMany($products);
    }

    public function syncLayoutOptions($shop) {
        $layoutOptions = LayoutOption::all();
        $shop->layoutOptions()->sync([]);
        $shop->layoutOptions()->saveMany($layoutOptions);
    }

    public function syncColors($shop) {
        $colors = Color::all();
        $shop->colors()->saveMany($colors);
    }

    public function syncSocialNetworks($shop) {
        $social_networks = SocialNetwork::all();
        $shop->socialNetworks()->saveMany($social_networks);
    }

    public function syncFilters($shop) {
        $filters = ShopFilter::all();
        $shop->filters()->saveMany($filters);
    }

    /**
     * Handle the Shop "created" event.
     *
     * @param Shop $shop
     * @return void
     */
    public function created(Shop $shop)
    {
        $categories = $this->createStartCategories($shop);
        $this->createStartProducts($shop, $categories);

        $this->syncLayoutOptions($shop);
        $this->syncColors($shop);
        $this->syncSocialNetworks($shop);
        $this->syncFilters($shop);
    }

    /**
     * Handle the Shop "updated" event.
     *
     * @param Shop $shop
     * @return void
     */
    public function updated(Shop $shop)
    {
//        $this->syncFilters($shop);
//        $this->syncLayoutOptions($shop);
//        $this->syncColors($shop);
    }

    /**
     * Handle the Shop "deleted" event.
     *
     * @param Shop $shop
     * @return void
     */
    public function deleted(Shop $shop)
    {
        //
    }

    /**
     * Handle the Shop "restored" event.
     *
     * @param Shop $shop
     * @return void
     */
    public function restored(Shop $shop)
    {
        //
    }

    /**
     * Handle the Shop "force deleted" event.
     *
     * @param Shop $shop
     * @return void
     */
    public function forceDeleted(Shop $shop)
    {
        //
    }
}
