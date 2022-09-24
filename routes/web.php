<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
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
    return view('sweet-home');
})->name('sweet-home');

Route::get('/produits', [ProductController::class, 'index'])->name('products');
Route::get('/contactez-nous', [ContactController::class, 'index'])->name('contact');
