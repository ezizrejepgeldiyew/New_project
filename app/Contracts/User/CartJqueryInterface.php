<?php

namespace App\Contracts\User;

use Illuminate\Http\Request;

interface CartJqueryInterface
{
   public function store();

   public function update(Request $request);

   public function remove(Request $request);
}
