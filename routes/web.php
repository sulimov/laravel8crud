<?php

namespace App\Http\Controllers;

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

// Admin area
Route::prefix('admin')->group(function () {
    // Products
    Route::resource('products', 'App\Http\Controllers\ProductsController')->except(['show']);
    Route::delete('/products/{id}/image', [ProductsController::class, 'deleteImage'])->name('product_image_delete');

    // Orders
    Route::get('/orders/store', [OrdersController::class, 'store']);
    Route::get('/orders/{id}/products', [OrdersController::class, 'getProducts']);
    Route::get('/orders/{id}/purchases', [OrdersController::class, 'getPurchases']);
});

// Products
Route::get('/', [ProductsFrontController::class, 'index']);
Route::get('/products/{id}', [ProductsFrontController::class, 'show'])->name('product-frontpage');

// Cart
Route::get('/cart', [CartController::class, 'show'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('add_to_cart');
Route::delete('/cart', [CartController::class, 'deleteProduct'])->name('delete_product_from_cart');
Route::post('/cart/update', [CartController::class, 'update'])->name('update_cart');

// Checkout
Route::get('/checkout', [CartController::class, 'showCheckout'])->name('checkout');

// Order
Route::post('/orders/create', [OrdersController::class, 'store'])->name('create_order');
Route::get('/orders/created/{id}', [OrdersController::class, 'showCreated'])->name('created_order');
