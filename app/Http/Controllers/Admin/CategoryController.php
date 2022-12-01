<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequests;
use App\Repository\CategoryRepository;

class CategoryController extends Controller
{
    public function index(CategoryRepository $category)
    {
        return view('Admin.category', ['category' => $category->get()]);
    }

    public function store(CreateCategoryRequests $request, CategoryRepository $category)
    {
        return back()->with('msg', $category->store($request));
    }

    public function update(CreateCategoryRequests $request, CategoryRepository $category)
    {
        return redirect()->route('category.index')->with('msg', $category->update($request, request('id')));
    }

    public function destroy($id, CategoryRepository $category)
    {
        return back()->with('msg', $category->destroy($id));
    }
}
