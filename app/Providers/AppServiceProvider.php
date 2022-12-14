<?php

namespace App\Providers;


use App\Http\Contracts\Hosting;
use App\Http\Services\StandardHosting;
use App\Http\Services\UkrApi;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            Hosting::class,
            function ($app) {
                return new StandardHosting();
            },
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
