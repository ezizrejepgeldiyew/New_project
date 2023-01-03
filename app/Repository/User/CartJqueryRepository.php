<?php

namespace App\Repository\User;

use App\Contracts\User\CartJqueryInterface;
use App\Models\Product;
use Illuminate\Http\Request;

class CartJqueryRepository implements CartJqueryInterface
{
    public function store()
    {
        $id = request('id');
        if (empty(request('quantity'))) {
            $quantity = 1;
        } else {
            $quantity = request('quantity');
        }
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else { 
            $cart[$id] = [
                "id" => $id,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->photo,
                "created_at" => $product->created_at,
                "discount" => $product->discount,
                "rating" => $product->rating
            ];
        }
        session()->put('cart', $cart);
        return response()->json($cart, 200);
    }

    public function update(Request $request)
    {
        $cart = session()->get("cart");
        if (empty($cart[$request->id])) {
            return response()->json(false, 200);
        }
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;
            $cart[$request->id]["id"] = $request->id;

            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
            $cart1 = $cart;
            return response()->json(
                [
                    $cart[$request->id],
                    $cart1
                ],
                200
            );
        }
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart');
        if ($request->id) {
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return response()->json($cart,200);
    }
}
