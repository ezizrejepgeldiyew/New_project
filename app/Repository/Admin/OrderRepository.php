<?php

namespace App\Repository\Admin;

use App\Contracts\Admin\OrderInterface;
use App\Models\Orders;
use App\Models\product;
use App\Models\ProductStatus;
use App\Repository\ProductDownloadsRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderInterface
{
    public function store()
    {
        $id = Auth::user()->id;
        $cart = session()->get('cart');
        $products_id = [];
        foreach ($cart as $item) {
            $products_id +=  [$item['id'] => (int)$item['quantity']];

            $data['user_id'] = $id;
            $data['product_id'] = (int)$item['id'];
            $data['quantity'] = (int)$item['quantity'];
            $add = ProductStatus::create($data);
        }
        $data['user_id'] = $id;
        $data['product_id'] = json_encode($products_id);
        $data['quantity'] = 1;
        $add = Orders::create($data);

        ProductDownloadsRepository::store($products_id);

    }

    public function count()
    {
        return Orders::count();
    }

    public function status()
    {
        return Orders::whereStatus(false)->count();
    }

    public function true()
    {
        $order = Orders::with('User', 'product')->whereStatus(1)->get();
        return $this->GenerateData($order);
    }

    public function false()
    {
        $order = Orders::with('User', 'product')->whereStatus(0)->get();
        return $this->GenerateData($order);
    }

    private function GenerateData($query)
    {
        return $query->map(function ($query) {
            $array = [];
            $ff = [];
            foreach (json_decode($query->product_id) as $key => $value) {
                $array[] = product::find($key);
                $ff[] = $value;
            }
            return [
                'status' => $query->status,
                'product_id' => $query->id,
                'user_name' => $query->user->name,
                'user_phone' => $query->user->phone_number,
                'products' => $array,
                'quantity' => $ff
            ];
        });
    }

    public function changestatus()
    {
        $id = request('id');
        DB::select("UPDATE `orders` SET `status` = !(SELECT orders.status WHERE orders.id = $id ) WHERE `orders`.`id` = $id");

    }
}

