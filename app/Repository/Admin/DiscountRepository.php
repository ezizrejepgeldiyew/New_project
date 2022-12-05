<?php

namespace App\Repository\Admin;

use App\Contracts\Admin\DiscountInterface;
use App\Models\Discount;
use App\Models\Product;

class DiscountRepository implements DiscountInterface
{
    public function __construct(Discount $discount)
    {
        $this->discount = $discount;
    }

    public function get()
    {
        return Discount::with('product')->get();
    }

    public function create()
    {
        return $this->product();
    }

    public function store()
    {
        $data = request()->all();
        $favorite = $data['product_id'];
        foreach ($favorite as $key => $value) {
            $data['product_id'] = $value;
            $add = Discount::create($data);
            Product::where('id', $value)->update([
                'discount' => $data['discount_price'],
            ]);
        }
        return response()->json(['data' => "success"], 200);
    }

    public function product()
    {
        return Product::whereNotNull('discount')->select('id', 'photo', 'name', 'price')->get();
    }
}
