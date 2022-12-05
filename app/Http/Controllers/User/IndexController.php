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
        MoneyCoursRepository $moneyCours,
        NoticesRepository $notices,
        CategoryRepository $category,
        ProductRepository $product
    ) {
        return view('User.index',
            [
                'money_cours' => $moneyCours->get(),
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
        MoneyCoursRepository $moneyCours
    ) {
        return view('User.store',
            [
                'category' => $category->get(),
                'ourbrand' => $ourbrand->get(),
                'product' => $product->get(),
                'money_cours' => $moneyCours->get()
            ]
        );
    }

    public function show(
        $id,
        MoneyCoursRepository $moneyCours,
        CategoryRepository $category,
        ProductRepository $product,
        ShowRepository $show
    ) {
        return view('User.product',
            [
                'money_cours' => $moneyCours->get(),
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
        MoneyCoursRepository $moneyCours
    ) {
        return view('User.checkout',
            [
                'category' => $category->get(),
                'money_cours' => $moneyCours->get(),
            ]
        );
    }

    public function cart(
        MoneyCoursRepository $moneyCours,
        CategoryRepository $category
    ) {
        return view('User.cart',
            [
                'money_cours' => $moneyCours->get(),
                'category' => $category->get(),
            ]
        );
    }
}
