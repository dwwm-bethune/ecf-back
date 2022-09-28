<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
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

Route::get('/', function () {
    return view('sweet-home', [
        'randomProducts' => Product::inRandomOrder()->limit(3)->get(),
        'randomFavorite' => Product::where('favorite', true)->inRandomOrder()->first(),
        'lastProducts' => Product::latest()->limit(4)->get(),
    ]);
})->name('sweet-home');

Route::get('/produits', [ProductController::class, 'index'])->name('products');
Route::get('/produits/{product}-{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categorie/{category}-{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/contactez-nous', [ContactController::class, 'index'])->name('contact');
