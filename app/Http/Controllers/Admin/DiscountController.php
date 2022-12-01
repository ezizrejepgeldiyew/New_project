<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\DiscountRepository;

class DiscountController extends Controller
{
    public function index(DiscountRepository $discount_product)
    {
        return view('Admin.Sale.index', ['discount_product' => $discount_product->get()]);
    }

    public function create(DiscountRepository $discount_product)
    {
        return view('Admin.Sale.create', ['discount_product' => $discount_product->product()]);
    }

    public function store(DiscountRepository $discount_product)
    {
        return view('Admin.Sale.create', [ 'discount_product' => $discount_product->store()]);
    }


}
