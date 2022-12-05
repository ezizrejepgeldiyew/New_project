<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Admin\DiscountRepository;

class DiscountController extends Controller
{
    public function index(DiscountRepository $discountProduct)
    {
        return view('Admin.Sale.index', ['discount_product' => $discountProduct->get()]);
    }

    public function create(DiscountRepository $discountProduct)
    {
        return view('Admin.Sale.create', ['discount_product' => $discountProduct->product()]);
    }

    public function store(DiscountRepository $discountProduct)
    {
        return view('Admin.Sale.create', [ 'discount_product' => $discountProduct->store()]);
    }


}
