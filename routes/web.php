<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OurBrandController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\MoneyCoursController;
use App\Http\Controllers\Admin\NoticesController;
use App\Http\Controllers\Admin\OnlineUsersController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductDownloadsController;
use App\Http\Controllers\CartJqueryController;
use App\Repository\DiscountRepository;
use App\Repository\ProductRepository;
use Illuminate\Support\Facades\Auth;

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




Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('checkout', 'checkout')->name('checkout');
    Route::get('cart', 'cart')->name('cart');
    Route::get('store', 'store')->name('store');
    Route::get('product1/{product}', 'product')->name('product1');
    Route::post('review/{product}', 'review')->name('review');
    Route::get('search', 'search')->name('search');
    Route::get('category_checkbox', 'category_checkbox')->name('category_checkbox');
    Route::post('price-filter', 'price')->name('price.filter');
});

Route::get('orderm', [OrderController::class, 'order'])->name('orderm');
Route::get('update_money/{id?}', [ProductRepository::class, 'update_money'])->name('update_money');

Route::controller(CartJqueryController::class)->group(function () {
    // CART AJAXu
    Route::get('add-to-cart', 'addToCart')->name('add.to.cart');
    Route::post('update-cart', 'update')->name('update.cart');
    Route::get('remove-from-cart', 'remove')->name('remove.from.cart');
    // WISH AJAX
    Route::get('add-to-wish', 'addToWish')->name('add.to.wish');
});


Auth::routes();

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::prefix('category/')->name('category.')->controller(CategoryController::class)->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

    Route::prefix('product/')->name('product.')->controller(ProductController::class)->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

    Route::prefix('ourbrand/')->name('ourbrand.')->controller(OurBrandController::class)->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

    Route::prefix('dicount_product/')->name('discount_product.')->controller(DiscountController::class)->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
    });

    Route::prefix('dicount_product/')->name('discount_product.api.')->controller(DiscountRepository::class)->group(function () {
        Route::post('store', 'store')->name('store');
    });

    Route::prefix('money_cours/')->name('money_cours.')->controller(MoneyCoursController::class)->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

    Route::prefix('notices/')->name('notices.')->controller(NoticesController::class)->group(function () {
        Route::get('index','index')->name('index');
        Route::post('store','store')->name('store');
        Route::put('update/{id}','update')->name('update');
        Route::delete('destroy/{id}','destroy')->name('destroy');
    });

    Route::prefix('product_downloads/')->name('product_downloads.')->controller(ProductDownloadsController::class)->group(function () {
        Route::get('index', 'index')->name('index');
    });


    Route::get('adminindex', [IndexController::class, 'adminindex'])->name('adminindex');
    Route::get('orders_false', [IndexController::class, 'orders_false'])->name('orders_false');
    Route::get('orders_true', [IndexController::class, 'orders_true'])->name('orders_true');
    Route::get('online_users', [OnlineUsersController::class, 'online_users'])->name('online_users');

    Route::get('orders_true/changestatus/{id}', [OrderController::class, 'ChangeStatus']);
    Route::get('orders_false/changestatus/{id}', [OrderController::class, 'ChangeStatus']);
});
