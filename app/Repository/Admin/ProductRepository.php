<?php

namespace App\Repository\Admin;

use App\Contracts\Admin\ProductInterface;
use App\Http\Requests\CreateProductRequests;
use App\Models\Category;
use App\Models\Ourbrand;
use App\Models\Product;
use App\Repository\PhotoSettings;

class ProductRepository implements ProductInterface
{
    protected $PhotoFolder = "PhonePhoto";
    protected $MultiplePhotosFolder = "PhonePhoto/Multiple";

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function get()
    {
        return Product::with('OurBrand')->get();
    }

    public function store(CreateProductRequests $request)
    {
        $data = $request->all();

        $data['photo'] = PhotoSettings::storePhoto($data['photo'], $this->PhotoFolder);
        $data['photos'] = PhotoSettings::storePhotos($data['photos'], $this->MultiplePhotosFolder);

        Category::find($data['category_id'])->increment('products');
        Ourbrand::find($data['ourbrand_id'])->increment('products');

        return Product::create($data);
    }

    public function update(CreateProductRequests $request, $id)
    {
        $product = $this->find($id);
        $data = $request->all();

        $data['photo'] = PhotoSettings::updatePhoto($data['photo'], $this->PhotoFolder, $product['photo']);
        $data['photos'] = PhotoSettings::updatePhotos($data['photos'], $this->MultiplePhotosFolder, $product['photos']);

        return $product->update($data);
    }

    public function destroy($id)
    {
        $product = $this->find($id);
        PhotoSettings::destroyPhoto($product['photo']);
        PhotoSettings::destroyPhotos(json_decode($product['photos']));

        Category::find($product->category_id)->decrement('products');
        Ourbrand::find($product->ourbrand_id)->decrement('products');

        return $product->delete();
    }

    public function find($id)
    {
        return Product::find($id);
    }

    public function random()
    {
        return Product::orderBy('updated_at', 'DESC')->inRandomOrder()->get()->take(10);
    }

}
