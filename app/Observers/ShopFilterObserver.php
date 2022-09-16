<?php

namespace App\Observers;

use App\Models\Shop;
use App\Models\ShopFilter;

class ShopFilterObserver
{
    public function syncFilters() {
        $filters = ShopFilter::all();

        Shop::all()->map(function (Shop $shop) use($filters) {
            $shop->filters()->sync($filters);
        });
    }

    /**
     * Handle the ShopFilter "created" event.
     *
     * @param ShopFilter $shopFilter
     * @return void
     */
    public function created(ShopFilter $shopFilter)
    {
        $this->syncFilters();
    }

    /**
     * Handle the ShopFilter "updated" event.
     *
     * @param ShopFilter $shopFilter
     * @return void
     */
    public function updated(ShopFilter $shopFilter)
    {
        $this->syncFilters();
    }

    /**
     * Handle the ShopFilter "deleted" event.
     *
     * @param ShopFilter $shopFilter
     * @return void
     */
    public function deleted(ShopFilter $shopFilter)
    {
        $this->syncFilters();
    }

    /**
     * Handle the ShopFilter "restored" event.
     *
     * @param ShopFilter $shopFilter
     * @return void
     */
    public function restored(ShopFilter $shopFilter)
    {
        //
    }

    /**
     * Handle the ShopFilter "force deleted" event.
     *
     * @param ShopFilter $shopFilter
     * @return void
     */
    public function forceDeleted(ShopFilter $shopFilter)
    {
        //
    }
}
