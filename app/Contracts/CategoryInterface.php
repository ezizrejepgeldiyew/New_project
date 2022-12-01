<?php

namespace App\Contracts;

use App\Http\Requests\CreateCategoryRequests;

interface CategoryInterface
{
    public function get();

    public function create();

    public function store(CreateCategoryRequests $request);

    public function update(CreateCategoryRequests $request, $id);

    public function destroy($id);
}
