<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Admin\AboutUsRepository;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(AboutUsRepository $aboutUs)
    {
        return view('Admin.about_us', ['aboutUs' => $aboutUs->get()]);
    }

    public function store(
        AboutUsRepository $aboutUs,
        Request $request
    ) {
        return back()->with('msg', $aboutUs->store($request));
    }

    public function update(
        $id,
        AboutUsRepository $aboutUs,
        Request $request
    ) {
        return redirect()->route('aboutUs.index')->with('msg', $aboutUs->update($id, $request));
    }

    public function destroy(
        $id,
        AboutUsRepository $aboutUs
    ) {
        return back()->with('msg', $aboutUs->destroy($id));
    }
}
