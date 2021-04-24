<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SubscribeController;
use App\Http\Middleware\OnlySudo;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [SiteController::class, 'index'])
    ->name('index');
Route::get('/news', [SiteController::class, 'news'])
    ->name('news');
Route::get('/user/{id}', [SiteController::class, 'user'])
    ->name('user');

Route::get('/admin/', [AuthController::class, 'index'])
    ->name('login');
Route::post('/admin/', [AuthController::class, 'login'])
    ->name('login.auth');
Route::get('/admin/logout', [AuthController::class, 'logout'])
    ->name('login.logout');

Route::get('/tag/{tag}', [SearchController::class, 'tags'])
    ->name('tag');
Route::get('/search/', [SearchController::class, 'search'])
    ->name('search');
Route::post('/search/api/', [SearchController::class, 'searchApi'])
    ->name('search.api');

Route::post('/subscribe/', [SubscribeController::class, 'store'])
    ->name('subscribe.add');

//TODO: Только админ
Route::middleware(OnlySudo::class)->group(function () {
    Route::get('/test', [SiteController::class, 'test']);


    Route::post('/{slug}/update', [MaterialController::class, 'update'])
        ->name('material.update');
    Route::get('/{slug}/url', [MaterialController::class, 'fetchUrl'])
        ->name('material.fetchUrl');
});

Route::get('/{slug}', [MaterialController::class, 'view'])
    ->name('category.material');

Route::post('/{slug}/comment', [MaterialController::class, 'comment'])
    ->name('material.comment');


