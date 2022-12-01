<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOurBrandRequests;
use App\Repository\OurBrandRepository;

class OurBrandController extends Controller
{
    public function index(OurBrandRepository $ourbrand)
    {
        return view('Admin.ourbrand',['ourbrands' => $ourbrand->get()]);
    }

    public function store(CreateOurBrandRequests $request, OurBrandRepository $ourbrand)
    {
        return back()->with('msg', $ourbrand->store($request));
    }

    public function update(CreateOurBrandRequests $request, OurBrandRepository $ourbrand)
    {
        return redirect()->route('ourbrand.index')->with('msg', $ourbrand->update($request,request('id')));
    }

    public function destroy(OurBrandRepository $ourbrand, $id)
    {
        return back()->with('msg', $ourbrand->destroy($id));
    }
}
