<?php

namespace App\Repository;

use App\Contracts\OurBrandInterface;
use App\Http\Requests\CreateOurBrandRequests;
use App\Models\ourbrand;

class OurBrandRepository implements OurBrandInterface
{
    protected $PhotoFolder = "OurBrand";

    public function __construct(ourbrand $ourbrand)
    {
        $this->ourbrand = $ourbrand;
    }
    public function get()
    {
        return ourbrand::get();
    }

    public function store(CreateOurBrandRequests $request)
    {
        $data = $request -> all();
        $data['photo'] = PhotoSettings::StorePhoto($data['photo'], $this->PhotoFolder);
        return ourbrand::create($data);
    }

    public function update(CreateOurBrandRequests $request, $id)
    {
        $ourbrand = $this -> find($id);
        $data = $request -> all();
        $data['photo'] = PhotoSettings::UpdatePhoto($data['photo'], $this->PhotoFolder, $ourbrand['photo']);
        return $ourbrand->update($data);
    }

    public function destroy($id)
    {
        $ourbrand = $this -> find($id);
        PhotoSettings::DestroyPhoto($ourbrand['photo']);
        return $ourbrand->delete();
    }

    public function find($id)
    {
        return ourbrand::find($id);
    }
}

