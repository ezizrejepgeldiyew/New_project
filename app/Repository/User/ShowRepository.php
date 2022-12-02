<?php

namespace App\Repository\User;

use App\Contracts\User\ShowInterface;
use App\Models\product;
use App\Models\review;
use Illuminate\Http\Request;

class ShowRepository implements ShowInterface
{
    public function review(Request $request, $id)
    {
        $data = $request->all();
        $data['product_id'] = $id;
        review::create($data);
        $rating = review::where('product_id', $id)->pluck('rating')->avg();
        $data = product::where('id', $id)->first();
        $data->rating = $rating;
        $data->save();
        return back();
    }

    public function rating($id)
    {
        return review::where('product_id', $id)->pluck('rating');
    }

    public function paginate()
    {
        return review::paginate(3);
    }

    public function count($id)
    {
        return $this->rating($id)->countBy();
    }
}

