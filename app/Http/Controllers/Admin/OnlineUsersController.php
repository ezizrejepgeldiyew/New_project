<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Admin\OnlineUsersRepository;

class OnlineUsersController extends Controller
{
    public function index(
        OnlineUsersRepository $onlineUsers
    ) {
        return view('Admin.online_users',
        [
            'online_users' => $onlineUsers->get(),
        ]);
    }
}
