<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\OnlineUsersRepository;
use Illuminate\Http\Request;

class OnlineUsersController extends Controller
{
    public function online_users(OnlineUsersRepository $online_users)
    {
        return view('Admin.online_users',['online_users' => $online_users->get()]);
    }
}
