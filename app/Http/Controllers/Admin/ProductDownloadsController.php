<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Admin\ProductDownloadsRepository;

class ProductDownloadsController extends Controller
{
    public function index(ProductDownloadsRepository $proDownloads)
    {
        return view('Admin.Product_Downloads.index',['pro_downloads' => $proDownloads->get()]);
    }
}
