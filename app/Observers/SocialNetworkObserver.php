<?php

namespace App\Observers;

use App\Models\Shop;
use App\Models\SocialNetwork;

class SocialNetworkObserver
{
    public function syncSocialNetworks() {
        $social_networks = SocialNetwork::all();

        Shop::all()->map(function (Shop $shop) use($social_networks) {
            $shop->socialNetworks()->sync($social_networks);
        });
    }

    /**
     * Handle the SocialNetwork "created" event.
     *
     * @param  \App\Models\SocialNetwork  $socialNetwork
     * @return void
     */
    public function created(SocialNetwork $socialNetwork)
    {
        $this->syncSocialNetworks();
    }

    /**
     * Handle the SocialNetwork "updated" event.
     *
     * @param  \App\Models\SocialNetwork  $socialNetwork
     * @return void
     */
    public function updated(SocialNetwork $socialNetwork)
    {
        $this->syncSocialNetworks();
    }

    /**
     * Handle the SocialNetwork "deleted" event.
     *
     * @param  \App\Models\SocialNetwork  $socialNetwork
     * @return void
     */
    public function deleted(SocialNetwork $socialNetwork)
    {
        $this->syncSocialNetworks();
    }

    /**
     * Handle the SocialNetwork "restored" event.
     *
     * @param  \App\Models\SocialNetwork  $socialNetwork
     * @return void
     */
    public function restored(SocialNetwork $socialNetwork)
    {
        //
    }

    /**
     * Handle the SocialNetwork "force deleted" event.
     *
     * @param  \App\Models\SocialNetwork  $socialNetwork
     * @return void
     */
    public function forceDeleted(SocialNetwork $socialNetwork)
    {
        //
    }
}
