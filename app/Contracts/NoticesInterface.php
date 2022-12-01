<?php

namespace App\Contracts;

use App\Http\Requests\NoticesRequest;

interface NoticesInterface
{
    public function get();

    public function store(NoticesRequest $request);

    public function update(NoticesRequest $request, $id);

    public function destroy($id);
}

