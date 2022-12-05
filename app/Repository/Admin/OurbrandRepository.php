<?php

namespace App\Repository\Admin;

use App\Contracts\Admin\OurBrandInterface;
use App\Http\Requests\CreateOurBrandRequests;
use App\Models\Ourbrand;
use App\Repository\PhotoSettings;

class OurBrandRepository implements OurBrandInterface
{
    protected $PhotoFolder = "OurBrand";

    public function __construct(Ourbrand $ourBrand)
    {
        $this->ourBrand = $ourBrand;
    }
    public function get()
    {
        return Ourbrand::get();
    }

    public function store(CreateOurBrandRequests $request)
    {
        $data = $request -> all();
        $data['photo'] = PhotoSettings::storePhoto($data['photo'], $this->PhotoFolder);
        return Ourbrand::create($data);
    }

    public function update(CreateOurBrandRequests $request, $id)
    {
        $ourBrand = $this -> find($id);
        $data = $request -> all();
        $data['photo'] = PhotoSettings::updatePhoto($data['photo'], $this->PhotoFolder, $ourBrand['photo']);
        return $ourBrand->update($data);
    }

    public function destroy($id)
    {
        $ourBrand = $this -> find($id);
        PhotoSettings::destroyPhoto($ourBrand['photo']);
        return $ourBrand->delete();
    }

    public function find($id)
    {
        return Ourbrand::find($id);
    }
}

