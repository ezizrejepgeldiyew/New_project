<?php

namespace App\Contracts\Admin;

use App\Http\Requests\MoneyCoursRequest;

interface MoneyCoursInterface
{
    public function get();

    public function store(MoneyCoursRequest $request);

    public function update(MoneyCoursRequest $request, $id);

    public function destroy($id);

    public function update_money($id);

}

