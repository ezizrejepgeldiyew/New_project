<?php

namespace App\Repository;

use App\Contracts\CategoryInterface;
use App\Http\Requests\CreateCategoryRequests;
use App\Models\category;

class CategoryRepository implements CategoryInterface
{
    public function __construct(category $category)
    {
        $this->category = $category;
    }

    public function get()
    {
        return category::get();
    }

    public function create()
    {
    }

    public function store($data)
    {
        return category::create($data->validated());
    }

    public function update(CreateCategoryRequests $request, $id)
    {
        $category = $this->find($id);
        $category->name = $request->name;
        return $category->save();
    }

    public function destroy($id)
    {
        return category::destroy($id);
    }

    public function find($id)
    {
        return category::find($id);
    }
}
