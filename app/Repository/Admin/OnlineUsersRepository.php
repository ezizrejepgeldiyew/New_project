<?php

namespace App\Repository\Admin;

use App\Contracts\Admin\OnlineUsersInterface;
use App\Models\User;

class OnlineUsersRepository implements OnlineUsersInterface
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function get()
    {
        return User::whereNotNull('last_seen')->orderBy('last_seen', 'DESC')->get();
    }
}
