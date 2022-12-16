<?php

use App\Http\Controllers\MiteDriveController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ViewController;
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

Route::get('/', [ViewController::class, 'home'])->name('welcome');
Route::get('/sitemap.xml', [SitemapController::class, 'posts'])->name('sitemap.posts');
Route::get('/category/{slug}', [ViewController::class, 'categories'])->name('category');
Route::get('/search', [ViewController::class, 'search'])->name('search');
Route::get('/{slug}', [ViewController::class, 'post'])->name('post');

Route::post('/checking', [MiteDriveController::class, 'checking']);
