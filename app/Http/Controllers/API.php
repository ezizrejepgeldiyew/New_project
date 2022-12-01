<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequests;
use App\Repository\CategoryRepository;
use Psr\Http\Message\ResponseInterface;

class API extends Controller
{
    public function store(CreateCategoryRequests $request, CategoryRepository $category)
    {
        $category->store($request);
        return response()->json([
            'message'=>'Oda sen',
            'category'=>$category,
        ]);
    }
}
