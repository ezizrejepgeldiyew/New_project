<?php

namespace App\Repository\Admin;

use App\Contracts\Admin\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    public function count()
    {
        return User::count();
    }
}
