<?php

namespace App\Repository\User;

use App\Contracts\User\StoreInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class StoreRepository implements StoreInterface
{
    public function loadMore()
    {
        $sortName = request('sortName');
        $sortBy = (int)request('sortBy');
        if (!empty($sortName) && !empty($this->getCookie('sortName'))) {
            Cookie::queue('sortName', $sortName);
            Cookie::queue('sortBy', $sortBy);
        }
        if (empty($sortName) && empty($this->getCookie('sortName'))) {
            Cookie::queue('sortName', 'Saýlanmadyk');
            Cookie::queue('sortBy', 3);
        }

        $query = new Product();

        if (empty(request('sortBy'))) $sortBy = Cookie::get('sortBy');

        $loadMore = (int)request('load');

        if ($sortBy != 3) {
            $orderBy = $sortBy == 2 ?  'desc' : 'asc';
        }

        if ($loadMore == 0) {
            if ($sortBy == 3) {
                return Product::limit(6)->get();
            } else {
                return Product::orderBy('price', $orderBy)->limit(6)->get();
            }
        }

        if (!empty(request('search'))) {
            $query = self::searchFilter($query, request('search'));
        }

        $query = self::priceFilter($query, request('minVal'), request('maxVal'));


        if (request('arr_id') != null) {
            $query = self::checkboxFilter($query, request('arr_id'));
        }

        $limit = 3;

        if ($loadMore == 9) {
            $loadMore = 3;
            $limit = 9;
        } elseif ($loadMore == 6) {
            $loadMore = 3;
            $limit = 6;
        }

        if ($sortBy == 3) {
            $query = $query->with('category')->offset($loadMore - 3)->limit($limit)->get();
        } else {
            $query = $query->with('category')->orderBy('price', $orderBy)->offset($loadMore - 3)->limit($limit)->get();
        }

        return response()->json($query, 200);
    }

    private function searchFilter($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->whereHas('ourbrand', function ($query1) use ($search) {
                $query1->where('name', 'Like', "%$search%");
            })->orWhere('name', 'Like', "%$search%");
        });
    }

    private function priceFilter($query, $minVal, $maxVal)
    {
        return $query->whereBetween('price',  [$minVal, $maxVal]);
    }

    private function checkboxFilter($query, $arr_id)
    {
        return  $query->whereIn('category_id', $arr_id);
    }

    public function sortCookie()
    {
        if (!empty(request('sortName')) && !empty($this->getCookie('sortName'))) {
            Cookie::queue('sortName', request('sortName'));
            Cookie::queue('sortBy', request('sortBy'));
        }
        if (empty($sortName) && empty($this->getCookie('sortName'))) {
            Cookie::queue('sortName', 'Saýlanmadyk');
            Cookie::queue('sortBy', 3);
        }
        return null;
    }

    public function getCookie($title)
    {
        return Cookie::get($title);
    }
}
