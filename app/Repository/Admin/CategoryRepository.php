<?php

namespace App\Repository\Admin;

use App\Contracts\Admin\CategoryInterface;
use App\Http\Requests\CreateCategoryRequests;
use App\Models\Category;

class CategoryRepository implements CategoryInterface
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function get()
    {
        return Category::get();
    }

    public function create()
    {
    }

    public function store($data)
    {
        return Category::create($data->validated());
    }

    public function update(CreateCategoryRequests $request, $id)
    {
        $category = $this->find($id);
        $category->name = $request->name;
        return $category->save();
    }

    public function destroy($id)
    {
        return Category::destroy($id);
    }

    public function find($id)
    {
        return Category::find($id);
    }
}
