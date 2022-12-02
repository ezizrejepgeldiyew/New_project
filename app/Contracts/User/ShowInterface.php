<?php

namespace App\Contracts\User;

use Illuminate\Http\Request;

interface ShowInterface
{
    public function review(Request $request, $id);

    public function rating($id);

    public function paginate();

    public function count($id);
}

