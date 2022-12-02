<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequests;
use App\Repository\Admin\CategoryRepository;
use App\Repository\Admin\OurBrandRepository;
use App\Repository\Admin\ProductRepository;

class ProductController extends Controller
{

    public function index(
        CategoryRepository $category,
        ProductRepository $product,
        OurBrandRepository $ourbrand
    ) {
        return view('Admin.product', [
            'category' => $category->get(),
            'product' => $product->get(),
            'ourbrand' => $ourbrand->get(),
        ]);
    }

    public function store(CreateProductRequests $request, ProductRepository $product)
    {
        return back()->with('msg', $product->store($request));
    }

    public function update(CreateProductRequests $request, ProductRepository $product)
    {
        return redirect()->route('product.index')->with('msg', $product->update($request, request('id')));
    }

    public function destroy(ProductRepository $product, $id)
    {
        return back()->with('msg', $product->destroy($id));
    }
}
