<?php

namespace App\Repository\User;

use App\Contracts\User\StoreInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

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

    public function showCookie()
    {
        $changeShow = (int)request('changeShow');

        if ($changeShow > 0 && !empty($this->getCookie('changeShow'))) {
            Cookie::queue('changeShow', $changeShow);
        }
        if ($changeShow == 0 && empty($this->getCookie('changeShow'))) {
            Cookie::queue('changeShow', 5);
        }
        $sortBy = Cookie::get('sortBy');
        if ($sortBy == 0) {
            return Product::paginate($this->getCookie('changeShow'));
        } elseif ($sortBy == 1) {
            $orderBy = 'asc';
        }  else {
            $orderBy = 'desc';
        }
        return Product::orderBy('price', $orderBy)->paginate($this->getCookie('changeShow'));
    }

    public function sortCookie()
    {
        $sortName = request('sortName');
        $sortBy = (int)request('sortBy');
        if (!empty($sortName) && !empty($this->getCookie('sortName'))) {
            Cookie::queue('sortName', $sortName);
            Cookie::queue('sortBy', $sortBy);
        }
        if (empty($sortName) && empty($this->getCookie('sortName'))) {
            Cookie::queue('sortName', 'Saýlanmadyk');
            Cookie::queue('sortBy', 0);
        }
    }

    public function getCookie($title)
    {
        return Cookie::get($title);
    }
}
