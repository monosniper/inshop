<?php

use App\Http\Controllers\Api\BasketApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ClientApiController;
use App\Http\Controllers\Api\DomainApiController;
use App\Http\Controllers\Api\FeedbackApiController;
use App\Http\Controllers\Api\HostingApiController;
use App\Http\Controllers\Api\LayoutOptionApiController;
use App\Http\Controllers\Api\ModuleApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\SettingApiController;
use App\Http\Controllers\Api\ShopApiController;
use App\Http\Controllers\Api\UploadApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api.'], function() {
    Route::post('/sanctum/token', [UserApiController::class, 'getApiToken']);
    Route::get('/me', [UserApiController::class, 'getMe'])->middleware('auth:sanctum');
    Route::post('files/upload/{uuid}/{path}', [UploadApiController::class, 'upload']);
    Route::post('files/delete', [UploadApiController::class, 'delete']);

    Route::middleware('auth:api')->group(function() {
        Route::group(['prefix' => 'hosting', 'as' => 'hosting.'], function() {
            Route::post('/register', [HostingApiController::class, 'registerDomain'])->name('register');
            Route::post('/check', [HostingApiController::class, 'checkDomain'])->name('check');
        });

        Route::group(['prefix' => 'user'], function() {
            Route::get('/', [UserApiController::class, 'me']);
            Route::get('/shops', [UserApiController::class, 'shops']);
            Route::get('/domains', [UserApiController::class, 'domains']);
        });
//        Route::group(['prefix' => 'basket'], function() {
//            Route::get('/{shop_id}/{client_id}', [BasketApiController::class, 'items']);
//            Route::post('/add', [BasketApiController::class, 'add']);
//            Route::delete('/remove/{basket_item}', [BasketApiController::class, 'remove']);
//        });
        Route::apiResources([
            'settings' => SettingApiController::class,
            'users' => UserApiController::class,
            'feedBacks' => FeedbackApiController::class,
            'modules' => ModuleApiController::class,
            'layoutOptions' => LayoutOptionApiController::class,
            'domains' => DomainApiController::class,
            'shops' => ShopApiController::class,
            'shops.products' => ProductApiController::class,
            'shops.clients' => ClientApiController::class,
            'shops.categories' => CategoryApiController::class,
            'shops.orders' => OrderApiController::class,
        ]);
    });

    Route::get('users/{user}/block', [UserApiController::class, 'block']);
    Route::get('users/{user}/unblock', [UserApiController::class, 'unblock']);

    Route::apiResource('shops.basket', BasketApiController::class);

    Route::get('get-shop', [ShopApiController::class, 'getShop']);
    Route::get('shops/{shop}/products', [ProductApiController::class, 'index']);

    Route::get('shops/{shop}/modules', [ModuleApiController::class, 'shopModules']);
    Route::get('shops/{shop}/modules/get/{module}', [ModuleApiController::class, 'getModule']);
    Route::get('shops/{shop}/modules/{module}/activate', [ModuleApiController::class, 'activate']);
    Route::get('shops/{shop}/modules/{module}/deactivate', [ModuleApiController::class, 'deactivate']);

    Route::get('shops/{shop}/clients', [ClientApiController::class, 'shopClients']);

    Route::post('shops/{shop}/products/deleteMany', [ProductApiController::class, 'deleteMany']);

    Route::get('shops/{shop}/layoutOptions', [LayoutOptionApiController::class, 'shopLayoutOptions']);
    Route::get('shops/{shop}/layoutOptions/{layoutOption}/activate', [LayoutOptionApiController::class, 'activate']);
    Route::get('shops/{shop}/layoutOptions/{layoutOption}/deactivate', [LayoutOptionApiController::class, 'deactivate']);

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
