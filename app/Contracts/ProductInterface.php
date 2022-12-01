<?php

namespace App\Contracts;

use App\Http\Requests\CreateProductRequests;

interface ProductInterface
{
    public function get();

    public function store(CreateProductRequests $request);

    public function update(CreateProductRequests $request, $id);

    public function destroy($id);

    public function update_money($id);
}

