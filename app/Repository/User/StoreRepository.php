<?php

namespace App\Repository\User;

use App\Contracts\User\StoreInterface;
use App\Models\Product;

class StoreRepository implements StoreInterface
{
    public function searchFilter()
    {
        $text = request('text');
        $search = Product::whereHas('ourbrand', function ($query) use ($text) {
            $query->where('name', 'Like', "%$text%");
        })->orWhere('name', 'Like', "%$text%")->with('category')->get();
        return response()->json($search, 200);
    }

    public function priceFilter()
    {
        $minVal = (int)request('minVal');
        $maxVal = (int)request('maxVal');
        $data = Product::where('price', '>=', $minVal)->where('price', '<=', $maxVal)->with('category')->get();
        return response()->json($data, 200);
    }

    public function checkboxFilter()
    {
        $id = request('id');
        $cart1 = [];
        if ($id == null) {
            $cart = Product::with('category')->get();
            array_push($cart1, $cart);
        } else {
            foreach ($id as $key => $value) {

                $cart = Product::where('category_id', $value)->with('category')->get();
                array_push($cart1, $cart);
            }
        }
        return response()->json($cart1, 200);
    }
}

