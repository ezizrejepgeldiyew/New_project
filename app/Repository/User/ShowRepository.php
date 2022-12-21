<?php

namespace App\Repository\User;

use App\Contracts\User\ShowInterface;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ShowRepository implements ShowInterface
{
    public function review(Request $request, $id)
    {
        $data = $request->all();
        $data['product_id'] = $id;

        Review::create($data);
        $rating = Review::where('product_id', $id)->pluck('rating')->avg();
        $data = Product::where('id', $id)->first();
        $data->rating = round($rating);
        $data->save();
        return back();
    }

    public function rating($id)
    {
        return Review::where('product_id', $id)->pluck('rating');
    }

    public function paginate()
    {
        return Review::paginate(3);
    }

    public function count($id)
    {
        return $this->rating($id)->countBy();
    }

    public function cartJquery($id)
    {
        $cart = session()->get('cart');
        if (!empty($cart)) {
            foreach ($cart as $key => $value) {
                if ($value['id'] == $id) {
                    return $cart[$id];
                }
            }
        }
    }
}
