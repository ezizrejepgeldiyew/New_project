<?php

namespace App\Repository;

use App\Contracts\OnlineUsersInterface;
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
