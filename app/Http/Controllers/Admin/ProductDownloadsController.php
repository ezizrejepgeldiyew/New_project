<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductDownloads;
use App\Repository\ProductDownloadsRepository;
use Illuminate\Http\Request;

class ProductDownloadsController extends Controller
{
    public function index(ProductDownloadsRepository $pro_downloads)
    {
        return view('Admin.Product_Downloads.index',['pro_downloads' => $pro_downloads->get()]);
    }
}
