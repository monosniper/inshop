<?php

namespace App\Observers;

use App\Models\LayoutOption;
use App\Models\Shop;

class LayoutOptionObserver
{
    public function syncLayoutOptions() {
        $layoutOptions = LayoutOption::all();

        Shop::all()->map(function (Shop $shop) use($layoutOptions) {
            $shop->layoutOptions()->sync($layoutOptions);
        });
    }

    /**
     * Handle the LayoutOption "created" event.
     *
     * @param LayoutOption $layoutOption
     * @return void
     */
    public function created(LayoutOption $layoutOption)
    {
        $this->syncLayoutOptions();
    }

    /**
     * Handle the LayoutOption "updated" event.
     *
     * @param LayoutOption $layoutOption
     * @return void
     */
    public function updated(LayoutOption $layoutOption)
    {
        $this->syncLayoutOptions();
    }

    /**
     * Handle the LayoutOption "deleted" event.
     *
     * @param LayoutOption $layoutOption
     * @return void
     */
    public function deleted(LayoutOption $layoutOption)
    {
        $this->syncLayoutOptions();
    }

    /**
     * Handle the LayoutOption "restored" event.
     *
     * @param LayoutOption $layoutOption
     * @return void
     */
    public function restored(LayoutOption $layoutOption)
    {
        //
    }

    /**
     * Handle the LayoutOption "force deleted" event.
     *
     * @param LayoutOption $layoutOption
     * @return void
     */
    public function forceDeleted(LayoutOption $layoutOption)
    {
        //
    }
}
