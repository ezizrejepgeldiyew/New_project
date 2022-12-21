<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repository\Admin\AboutUsRepository;
use App\Repository\Admin\CategoryRepository;
use App\Repository\Admin\MoneyCoursRepository;
use App\Repository\Admin\NoticesRepository;
use App\Repository\Admin\OurBrandRepository;
use App\Repository\Admin\ProductDownloadsRepository;
use App\Repository\Admin\ProductRepository;
use App\Repository\User\ShowRepository;
use App\Repository\User\StoreRepository;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function index(
        MoneyCoursRepository $moneyCours,
        NoticesRepository $notices,
        CategoryRepository $category,
        ProductRepository $product,
        AboutUsRepository $aboutUs
    ) {
        // $addCache = Cache::remember('key', 120, function () {
        //     return Product::all();
        // });
        // dd(Cache::get('key'));
        return view('User.index',
            [
                'money_cours' => $moneyCours->get(),
                'notices' => $notices->get(),
                'category' => $category->get(),
                'product' => $product->random(),
                'aboutUs' => $aboutUs->first(),
            ]
        );
    }

    public function store(
        CategoryRepository $category,
        OurBrandRepository $ourbrand,
        StoreRepository $store,
        MoneyCoursRepository $moneyCours,
        AboutUsRepository $aboutUs,
        ProductDownloadsRepository $productDownload
    ) {

        return view('User.store',
            [
                'category' => $category->get(),
                'ourbrand' => $ourbrand->get(),
                'product' => $store->showCookie(),
                'topSelling' => $productDownload->take(),
                'showCookieName' => $store->getCookie('changeShow'),
                'sortCookieName' => $store->getCookie('sortName'),
                'sort' => $store->sortCookie(),
                'money_cours' => $moneyCours->get(),
                'aboutUs' => $aboutUs->first(),
            ]
        );
    }

    public function show(
        $id,
        MoneyCoursRepository $moneyCours,
        CategoryRepository $category,
        ProductRepository $product,
        ShowRepository $show,
        AboutUsRepository $aboutUs
    ) {
        // dd($product->get());
        return view('User.product',
            [
                'money_cours' => $moneyCours->get(),
                'category' => $category->get(),
                'products' => $product->get(),
                'product' => $product->find($id),
                'review' => $show->paginate(),
                'count' => $show->count($id),
                'cart' => $show->cartJquery($id),
                'aboutUs' => $aboutUs->first(),
            ]
        );
    }

    public function checkout(
        CategoryRepository $category,
        MoneyCoursRepository $moneyCours,
        AboutUsRepository $aboutUs
    ) {
        return view('User.checkout',
            [
                'category' => $category->get(),
                'money_cours' => $moneyCours->get(),
                'aboutUs' => $aboutUs->first(),
            ]
        );
    }

    public function cart(
        MoneyCoursRepository $moneyCours,
        CategoryRepository $category,
        AboutUsRepository $aboutUs
    ) {
        return view('User.cart',
            [
                'money_cours' => $moneyCours->get(),
                'category' => $category->get(),
                'aboutUs' => $aboutUs->first(),
            ]
        );
    }
}
