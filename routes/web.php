<?php

use App\Http\Controllers\Admin\AboutUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\IndexController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OurBrandController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\MoneyCoursController;
use App\Http\Controllers\Admin\NoticesController;
use App\Http\Controllers\Admin\OnlineUsersController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductDownloadsController;
use App\Repository\Admin\DiscountRepository;
use App\Repository\Admin\MoneyCoursRepository;
use App\Repository\User\CartJqueryRepository;
use App\Repository\User\ShowRepository;
use App\Repository\User\StoreRepository;
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
    Route::get('store', 'store')->name('store');
    Route::get('show/{id}', 'show')->name('show');
    Route::get('checkout', 'checkout')->name('checkout');
    Route::get('cart', 'cart')->name('cart');
});


Route::get('update_money/{id?}', [MoneyCoursRepository::class, 'updateMoney'])->name('update_money');

Route::prefix('cartjquery/')->name('cartjquery.')->controller(CartJqueryRepository::class)->group(function(){
    Route::get('store', 'store') ->name('store');
    Route::post('update', 'update') ->name('update');
    Route::get('remove', 'remove') ->name('remove');
});

Route::prefix('store/')->name('store.')->controller(StoreRepository::class)->group(function () {
    Route::get('search-filter', 'searchFilter')->name('search_filter');
    Route::post('price-filter', 'priceFilter')->name('price_filter');
    Route::get('checkbox-filter', 'checkboxFilter')->name('checkbox_filter');
    Route::get('show/{changeShow?}', 'showCookie')->name('show');
    Route::post('sort', 'sortCookie')->name('sort');
});

Route::prefix('show/')->name('show.')->controller(ShowRepository::class)->group(function () {
    Route::post('review/{id}', 'review')->name('review');
});

Route::prefix('order/')->name('order.')->controller(OrderController::class)->group(function () {
    Route::get('store', 'store')->name('store');
    Route::get('change-status', 'changeStatus')->name('changestatus');
});

Auth::routes();

Route::prefix('admin/')->middleware(['admin'])->group(function () {
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

    Route::prefix('dicount-product/')->name('discount_product.')->controller(DiscountController::class)->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
    });

    Route::prefix('dicount-product/')->name('discount_product.api.')->controller(DiscountRepository::class)->group(function () {
        Route::post('store', 'store')->name('store');
    });

    Route::prefix('money-cours/')->name('money_cours.')->controller(MoneyCoursController::class)->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

    Route::prefix('notices/')->name('notices.')->controller(NoticesController::class)->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

    Route::prefix('product-downloads/')->name('product_downloads.')->controller(ProductDownloadsController::class)->group(function () {
        Route::get('index', 'index')->name('index');
    });

    Route::prefix('aboutUs/')->name('aboutUs.')->controller(AboutUsController::class)->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

    Route::name('admin.')->controller(AdminIndexController::class)->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('orders-true', 'ordersTrue')->name('orders_true');
        Route::get('orders-false', 'ordersFalse')->name('orders_false');
    });

    Route::prefix('online-users')->name('online_users.')->controller(OnlineUsersController::class)->group(function(){
        Route::get('index', 'index')->name('index');
    });

});
