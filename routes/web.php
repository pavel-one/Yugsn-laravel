<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SubscribeController;
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
Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/news', [SiteController::class, 'news'])->name('news');
Route::get('/user/{id}', [SiteController::class, 'user'])->name('user');

Route::get('/tag/{tag}', [SearchController::class, 'tags'])->name('tag');
Route::get('/search/', [SearchController::class, 'search'])->name('search');
Route::post('/search/api/', [SearchController::class, 'searchApi'])->name('search.api');

Route::post('/subscribe/', [SubscribeController::class, 'store'])->name('subscribe.add');

Route::get('/test', [SiteController::class, 'test']); //TODO: Удалить

Route::get('/{slug}', [SiteController::class, 'categoryOrMaterial'])
    ->name('category.material');


