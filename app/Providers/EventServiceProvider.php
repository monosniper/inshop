<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Color;
use App\Models\LayoutOption;
use App\Models\Shop;
use App\Models\ShopFilter;
use App\Models\SocialNetwork;
use App\Observers\ClientObserver;
use App\Observers\ColorObserver;
use App\Observers\LayoutOptionObserver;
use App\Observers\ShopFilterObserver;
use App\Observers\ShopObserver;
use App\Observers\SocialNetworkObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Shop::observe(ShopObserver::class);
        ShopFilter::observe(ShopFilterObserver::class);
        LayoutOption::observe(LayoutOptionObserver::class);
        Color::observe(ColorObserver::class);
        Client::observe(ClientObserver::class);
        SocialNetwork::observe(SocialNetworkObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
