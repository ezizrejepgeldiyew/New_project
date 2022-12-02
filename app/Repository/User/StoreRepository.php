<?php

namespace App\Repository\User;

use App\Contracts\User\StoreInterface;
use App\Models\product;

class StoreRepository implements StoreInterface
{
    public function search_filter()
    {
        $text = request('text');
        $search = product::whereHas('ourbrand', function ($query) use ($text) {
            $query->where('name', 'Like', "%$text%");
        })->orWhere('name', 'Like', "%$text%")->with('category')->get();
        return response()->json($search, 200);
    }

    public function price_filter()
    {
        $minVal = (int)request('minVal');
        $maxVal = (int)request('maxVal');
        $data = product::where('price', '>=', $minVal)->where('price', '<=', $maxVal)->with('category')->get();
        return response()->json($data, 200);
    }

    public function checkbox_filter()
    {
        $id = request('id');
        $cart1 = [];
        if ($id == null) {
            $cart = product::with('category')->get();
            array_push($cart1, $cart);
        } else {
            foreach ($id as $key => $value) {

                $cart = product::where('category_id', $value)->with('category')->get();
                array_push($cart1, $cart);
            }
        }
        return response()->json($cart1, 200);
    }
}

