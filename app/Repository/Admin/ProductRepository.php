<?php

namespace App\Repository\Admin;

use App\Contracts\Admin\ProductInterface;
use App\Http\Requests\CreateProductRequests;
use App\Models\category;
use App\Models\ourbrand;
use App\Models\product;
use App\Repository\PhotoSettings;

class ProductRepository implements ProductInterface
{
    protected $PhotoFolder = "PhonePhoto";
    protected $MultiplePhotosFolder = "PhonePhoto/Multiple";

    public function __construct(product $product)
    {
        $this->product = $product;
    }

    public function get()
    {
        return product::with('ourbrand')->get();
    }

    public function store(CreateProductRequests $request)
    {
        $data = $request->all();

        $data['photo'] = PhotoSettings::StorePhoto($data['photo'], $this->PhotoFolder);
        $data['photos'] = PhotoSettings::StorePhotos($data['photos'], $this->MultiplePhotosFolder);

        category::find($data['category_id'])->increment('products');
        ourbrand::find($data['ourbrand_id'])->increment('products');

        return product::create($data);
    }

    public function update(CreateProductRequests $request, $id)
    {
        $product = $this->find($id);
        $data = $request->all();

        $data['photo'] = PhotoSettings::UpdatePhoto($data['photo'], $this->PhotoFolder, $product['photo']);
        $data['photos'] = PhotoSettings::UpdatePhotos($data['photos'], $this->MultiplePhotosFolder, $product['photos']);

        return $product->update($data);
    }

    public function destroy($id)
    {
        $product = $this->find($id);
        PhotoSettings::DestroyPhoto($product['photo']);
        PhotoSettings::DestroyPhotos(json_decode($product['photos']));

        category::find($product->category_id)->decrement('products');
        ourbrand::find($product->ourbrand_id)->decrement('products');

        return $product->delete();
    }

    public function find($id)
    {
        return product::find($id);
    }

    public function random()
    {
        return product::inRandomOrder()->get();
    }

}
