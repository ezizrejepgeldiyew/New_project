<?php

namespace App\Repository;

use App\Contracts\ProductDownloadsInterface;
use App\Models\ProductDownloads;
use Illuminate\Support\Facades\DB;

class ProductDownloadsRepository implements ProductDownloadsInterface

{
    public function get()
    {
        return ProductDownloads::with('product')->get();
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
