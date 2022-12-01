<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\ProductStatus;
use App\Repository\ProductDownloadsRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function order()
    {
        $id = Auth::user()->id;
        $cart = session()->get('cart');
        $products_id = [];
        foreach ($cart as $item) {
            $products_id +=  [$item['id'] => (int)$item['quantity']];

            $add = new ProductStatus;
            $add->user_id = $id;
            $add->product_id = (int)$item['id'];
            $add->quantity = (int)$item['quantity'];
            $add->save();
        }


        $add = new Orders;
        $add->user_id = $id;
        $add->product_id = json_encode($products_id);
        $add->quantity = 1;
        $add->save();
        ProductDownloadsRepository::store($products_id);


        return back()->with([
            'success' => "Maglumat üstünlikli ugradyldy"
        ]);
    }

    public function ChangeStatus()
    {
        $id = request('id');
        DB::select("UPDATE `orders` SET `status` = !(SELECT orders.status WHERE orders.id = $id ) WHERE `orders`.`id` = $id");

        return response()->json(['message' => "ok"], 200);
    }
}
