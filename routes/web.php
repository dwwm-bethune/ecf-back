<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
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
        'bestProducts' => Product::withAvg('reviews', 'note')->limit(4)->get()->sortByDesc('reviews_avg_note'),
    ]);
})->name('sweet-home');

Route::get('/produits', [ProductController::class, 'index'])->name('products');
Route::get('/produits/{product}-{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categorie/{category}-{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/contactez-nous', [ContactController::class, 'index'])->name('contact');

Route::post('/commentaire/{product}', [ReviewController::class, 'store'])->name('reviews.store');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/produits', [AdminProductController::class, 'index'])->name('admin.products');
    Route::get('/admin/produits/creer', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/produits', [AdminProductController::class, 'store']);
    Route::get('/admin/produits/{product}/modifier', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/produits/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/produits/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.delete');
});

Auth::routes();
