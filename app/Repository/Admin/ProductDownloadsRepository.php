<?php

namespace App\Repository\Admin;

use App\Contracts\Admin\ProductDownloadsInterface;
use App\Models\ProductDownloads;

class ProductDownloadsRepository implements ProductDownloadsInterface

{
    public function get()
    {
        return ProductDownloads::with('product')->get();
    }

    public function take()
    {
        return ProductDownloads::with('product')->orderBy('download', 'desc')->get()->take(1);
    }

    public static function store($request)
    {
        foreach ($request as $key => $value) {
            ProductDownloads::where('product_id', $key)->count() > 0 ?
                ProductDownloads::where('product_id', $key)->increment('download', $value) :
                ProductDownloads::create([
                    'product_id' => $key,
                    'download' => $value,
                ]);
        }
    }
}
