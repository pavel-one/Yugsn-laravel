<?php

use App\Http\Controllers\SiteController;
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
Route::get('/tag/{tag}', [SiteController::class, 'tags'])->name('tag');
Route::get('/user/{id}', [SiteController::class, 'user'])->name('user');
Route::get('/search/', [SiteController::class, 'search'])->name('search');

Route::get('/test', [SiteController::class, 'test']); //TODO: Удалить

Route::get('/{slug}', [SiteController::class, 'categoryOrMaterial'])
    ->name('category.material');


