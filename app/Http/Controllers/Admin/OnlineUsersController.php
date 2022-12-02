<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Admin\OnlineUsersRepository;

class OnlineUsersController extends Controller
{
    public function index(
        OnlineUsersRepository $online_users
    ) {
        return view('Admin.online_users',
        [
            'online_users' => $online_users->get(),
        ]);
    }
}
