<?php

namespace App\Contracts;

use App\Http\Requests\CreateOurBrandRequests;

interface OurBrandInterface
{
    public function get();

    public function store(CreateOurBrandRequests $request);

    public function update(CreateOurBrandRequests $request, $id);

    public function destroy($id);
}

