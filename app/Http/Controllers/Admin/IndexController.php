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
        $a = ['100', '41', '35', '51', '49', '62', '69', '91', '148'];
        return view(
            'Admin.index',
            [
                'user' => $user->count(),
                'zakazlar' => $order->count(),
                'ugradylmadyk' => $order->status(),
            ],
        )->with('a',json_encode($a,JSON_NUMERIC_CHECK));
    }

    public function ordersTrue(
        OrderRepository $order
    ) {
        return view(
            'Admin.order_true',
            [
                'order' => $order->true(),
            ]
        );
    }

    public function ordersFalse(
        OrderRepository $order
    ) {
        return view(
            'Admin.order_false',
            [
                'order' => $order->false()
            ]
        );
    }
}
