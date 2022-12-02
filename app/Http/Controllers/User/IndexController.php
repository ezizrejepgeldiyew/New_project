<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repository\Admin\CategoryRepository;
use App\Repository\Admin\MoneyCoursRepository;
use App\Repository\Admin\NoticesRepository;
use App\Repository\Admin\OurBrandRepository;
use App\Repository\Admin\ProductRepository;
use App\Repository\User\ShowRepository;

class IndexController extends Controller
{
    public function index(
        MoneyCoursRepository $money_cours,
        NoticesRepository $notices,
        CategoryRepository $category,
        ProductRepository $product
    ) {
        return view('User.index',
            [
                'money_cours' => $money_cours->get(),
                'notices' => $notices->get(),
                'category' => $category->get(),
                'product' => $product->random(),
            ]
        );
    }

    public function store(
        CategoryRepository $category,
        OurBrandRepository $ourbrand,
        ProductRepository $product,
        MoneyCoursRepository $money_cours
    ) {
        return view('User.store',
            [
                'category' => $category->get(),
                'ourbrand' => $ourbrand->get(),
                'product' => $product->get(),
                'money_cours' => $money_cours->get()
            ]
        );
    }

    public function show(
        $id,
        MoneyCoursRepository $money_cours,
        CategoryRepository $category,
        ProductRepository $product,
        ShowRepository $show
    ) {
        return view('User.product',
            [
                'money_cours' => $money_cours->get(),
                'category' => $category->get(),
                'products' => $product->get(),
                'product' => $product->find($id),
                'review' => $show->paginate(),
                'count' => $show->count($id),
            ]
        );
    }

    public function checkout(
        CategoryRepository $category,
        MoneyCoursRepository $money_cours
    ) {
        return view('User.checkout',
            [
                'category' => $category->get(),
                'money_cours' => $money_cours->get(),
            ]
        );
    }

    public function cart(
        MoneyCoursRepository $money_cours,
        CategoryRepository $category
    ) {
        return view('User.cart',
            [
                'money_cours' => $money_cours->get(),
                'category' => $category->get(),
            ]
        );
    }
}
