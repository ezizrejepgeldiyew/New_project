<?php

namespace App\Contracts;

use App\Http\Requests\MoneyCoursRequest;

interface MoneyCoursInterface
{
    public function get();

    public function store(MoneyCoursRequest $request);

    public function update(MoneyCoursRequest $request, $id);

    public function destroy($id);

}

