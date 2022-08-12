<?php

use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/our-shops', [HomeController::class, 'ourShops'])->name('ourShops');

Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/confidential', [HomeController::class, 'confidential'])->name('confidential');
Route::get('/sitemap', [HomeController::class, 'sitemap'])->name('sitemap');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/updates', [HomeController::class, 'updates'])->name('updates');
Route::get('/use-conditions', [HomeController::class, 'useConditions'])->name('use_conditions');
Route::get('/domains/register', [HomeController::class, 'domains'])->name('domains');
Route::get('/hosting', [HomeController::class, 'hosting'])->name('hosting');
Route::get('/seo', [HomeController::class, 'seo'])->name('seo');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/report', [HomeController::class, 'report'])->name('report');

Route::post('/contact', [FeedBackController::class, 'contact']);

Route::group(['as' => 'dashboard.', 'middleware' => 'auth', 'prefix' => 'dashboard'], function() {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/domains', [DashboardController::class, 'domains'])->name('domains');
    Route::get('/support', [DashboardController::class, 'support'])->name('support');
    Route::post('/support', [DashboardController::class, 'supportSend']);
});

Route::resources([
    'domains' => DomainController::class,
]);

Route::get('/refresh', [UserApiController::class, 'refresh'])
    ->middleware('auth:api')
    ->name('refresh');

require __DIR__.'/auth.php';
