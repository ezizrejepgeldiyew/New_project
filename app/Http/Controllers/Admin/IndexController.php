<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Admin\OrderRepository;
use App\Repository\Admin\UserRepository;

class IndexController extends Controller
{
    public function index(
        OrderRepository $order,
        UserRepository $user
    ) {
        return view('Admin.index',
        [
            'user' => $user->count(),
            'zakazlar' => $order->count(),
            'ugradylmadyk' => $order->status(),
        ]);
    }

    public function orders_true(
        OrderRepository $order
    ) {
        return view('Admin.order_true',
        [
            'order' => $order->true(),
        ]);
    }

    public function orders_false(
        OrderRepository $order
    ) {
        return view('Admin.order_false',
        [
            'order' => $order->false()
        ]);
    }
}
