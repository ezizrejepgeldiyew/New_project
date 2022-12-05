<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Admin\OrderRepository;

class OrderController extends Controller
{
    public function store(
        OrderRepository $order
    ) {
        $order->store();
        return back();
    }

    public function changeStatus(
        OrderRepository $order
    ) {
        $order->changeStatus();
        return response()->json(['message' => "ok"], 200);
    }
}
