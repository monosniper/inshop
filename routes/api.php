<?php

use App\Http\Controllers\Api\BannerApiController;
use App\Http\Controllers\Api\BasketApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ClientApiController;
use App\Http\Controllers\Api\ColorApiController;
use App\Http\Controllers\Api\CustomPageApiController;
use App\Http\Controllers\Api\DomainApiController;
use App\Http\Controllers\Api\FeedbackApiController;
use App\Http\Controllers\Api\HostingApiController;
use App\Http\Controllers\Api\LayoutOptionApiController;
use App\Http\Controllers\Api\ModuleApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\ReviewApiController;
use App\Http\Controllers\Api\SettingApiController;
use App\Http\Controllers\Api\ShopApiController;
use App\Http\Controllers\Api\ShopFilterApiController;
use App\Http\Controllers\Api\SocialNetworkApiController;
use App\Http\Controllers\Api\UploadApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api.'], function() {
    Route::post('/qiwi/callback', [OrderApiController::class, 'qiwiPayCallback']);

    Route::post('/sanctum/token', [UserApiController::class, 'getApiToken']);
    Route::get('/me', [UserApiController::class, 'getMe'])->middleware('auth:sanctum');
    Route::post('files/upload/{uuid}/{path}/{single?}', [UploadApiController::class, 'upload']);
    Route::post('files/delete', [UploadApiController::class, 'delete']);
    Route::get('files/get/{uuid}/{path}/{name?}', [UploadApiController::class, 'get']);

    Route::group([
            'middleware' => 'auth:api'
        ], function() {
        Route::group(['prefix' => 'hosting', 'as' => 'hosting.'], function() {
            Route::post('/register', [HostingApiController::class, 'registerDomain'])->name('register');
            Route::post('/check', [HostingApiController::class, 'checkDomain'])->name('check');
        });

        Route::group(['prefix' => 'user'], function() {
            Route::get('/', [UserApiController::class, 'me']);
            Route::get('/shops', [UserApiController::class, 'shops']);
            Route::get('/domains', [UserApiController::class, 'domains']);

            Route::post('/change-password', [UserApiController::class, 'changePassword']);
            Route::put('/update', [UserApiController::class, 'updateData']);
        });
    });

    Route::apiResources([
        'settings' => SettingApiController::class,
        'users' => UserApiController::class,
        'feedBacks' => FeedbackApiController::class,
        'modules' => ModuleApiController::class,
        'layoutOptions' => LayoutOptionApiController::class,
        'domains' => DomainApiController::class,
        'colors' => ColorApiController::class,
        'filters' => ShopFilterApiController::class,
        'shops' => ShopApiController::class,
        'social_networks' => SocialNetworkApiController::class,
        'shops.products' => ProductApiController::class,
        'shops.clients' => ClientApiController::class,
        'shops.categories' => CategoryApiController::class,
        'shops.orders' => OrderApiController::class,
        'shops.colors' => ColorApiController::class,
        'shops.social_networks' => SocialNetworkApiController::class,
        'shops.banners' => BannerApiController::class,
        'shops.customPages' => CustomPageApiController::class,
        'shops.reviews' => ReviewApiController::class,
        'shops.basket' => BasketApiController::class,
    ]);

    Route::post('domains/deleteMany', [DomainApiController::class, 'deleteMany']);

    Route::get('users/{user}/block', [UserApiController::class, 'block']);
    Route::get('users/{user}/unblock', [UserApiController::class, 'unblock']);

    Route::get('get-shop', [ShopApiController::class, 'getShop']);
    Route::get('shops/{shop}/products', [ProductApiController::class, 'index']);

    Route::get('shops/{shop}/modules', [ModuleApiController::class, 'shopModules']);
    Route::get('shops/{shop}/modules/get/{module}', [ModuleApiController::class, 'getModule']);
    Route::get('shops/{shop}/modules/{module}/activate', [ModuleApiController::class, 'activate']);
    Route::get('shops/{shop}/modules/{module}/deactivate', [ModuleApiController::class, 'deactivate']);

    Route::get('shops/{shop}/customPages/{customPage}/activate', [CustomPageApiController::class, 'activate']);
    Route::get('shops/{shop}/customPages/{customPage}/deactivate', [CustomPageApiController::class, 'deactivate']);

    Route::get('banners/types', [BannerApiController::class, 'getTypes']);

    Route::get('shops/{shop}/clients', [ClientApiController::class, 'shopClients']);

    Route::get('shops/{shop}/colors', [ColorApiController::class, 'shopColors']);
    Route::get('shops/{shop}/colors/{color}/reset', [ColorApiController::class, 'reset']);
    Route::put('shops/{shop}/colors/{color}/save', [ColorApiController::class, 'save']);

    Route::get('shops/{shop}/social_networks', [SocialNetworkApiController::class, 'shopSocialNetworks']);
    Route::put('shops/{shop}/social_networks/{social_network}/save', [SocialNetworkApiController::class, 'save']);

    Route::post('shops/{shop}/categories/deleteMany', [CategoryApiController::class, 'deleteMany']);
    Route::post('shops/{shop}/products/deleteMany', [ProductApiController::class, 'deleteMany']);
    Route::post('shops/{shop}/orders/deleteMany', [OrderApiController::class, 'deleteMany']);

    Route::get('shops/{shop}/layoutOptions', [LayoutOptionApiController::class, 'shopLayoutOptions']);
    Route::get('shops/{shop}/layoutOptions/{layoutOption}/activate', [LayoutOptionApiController::class, 'activate']);
    Route::get('shops/{shop}/layoutOptions/{layoutOption}/deactivate', [LayoutOptionApiController::class, 'deactivate']);

    Route::get('shops/{shop}/filters', [ShopFilterApiController::class, 'shopFilters']);
    Route::get('shops/{shop}/filters/{filter}/activate', [ShopFilterApiController::class, 'activate']);
    Route::get('shops/{shop}/filters/{filter}/deactivate', [ShopFilterApiController::class, 'deactivate']);

    Route::post('/shops/{shop}/orders', [OrderApiController::class, 'store']);

    Route::post('/shops/{shop}/register', [ShopApiController::class, 'registerClient']);
    Route::post('/shops/{shop}/login', [ShopApiController::class, 'loginClient']);

    Route::post('/shops/refresh', [ShopApiController::class, 'refreshClient'])->middleware('auth:sanctum');

    Route::group(['prefix' => 'inside', 'as' => 'inside.', 'middleware' => 'signed'], function() {
        Route::group(['prefix' => 'hosting', 'as' => 'hosting.'], function() {
            Route::post('/register', [HostingApiController::class, 'registerDomain'])->name('register');
            Route::post('/check', [HostingApiController::class, 'checkDomain'])->name('check');
        });
    });

    Route::post('/shops/{shop}/sanctum/token', [ShopApiController::class, 'getClientToken']);
});
