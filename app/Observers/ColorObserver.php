<?php

namespace App\Observers;

use App\Models\Color;
use App\Models\Shop;

class ColorObserver
{
    public function syncColors() {
        $colors = Color::all();

        Shop::all()->map(function (Shop $shop) use($colors) {
            $shop->colors()->sync($colors);
        });
    }

    /**
     * Handle the Color "created" event.
     *
     * @param Color $color
     * @return void
     */
    public function created(Color $color)
    {
        $this->syncColors();
    }

    /**
     * Handle the Color "updated" event.
     *
     * @param Color $color
     * @return void
     */
    public function updated(Color $color)
    {
        $this->syncColors();
    }

    /**
     * Handle the Color "deleted" event.
     *
     * @param Color $color
     * @return void
     */
    public function deleted(Color $color)
    {
        $this->syncColors();
    }

    /**
     * Handle the Color "restored" event.
     *
     * @param Color $color
     * @return void
     */
    public function restored(Color $color)
    {
        //
    }

    /**
     * Handle the Color "force deleted" event.
     *
     * @param Color $color
     * @return void
     */
    public function forceDeleted(Color $color)
    {
        //
    }
}
