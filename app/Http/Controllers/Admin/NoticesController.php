<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoticesRequest;
use App\Repository\NoticesRepository;

class NoticesController extends Controller
{
    public function index(NoticesRepository $notices)
    {
        return view('Admin.notices',['notices' => $notices->get()]);
    }

    public function store(NoticesRequest $request, NoticesRepository $notices)
    {
        return back()->with('success', $notices->store($request));
    }

    public function update(NoticesRequest $request, NoticesRepository $notices)
    {
        return redirect()->route('notices.index')->with('success', $notices->update($request, request('id')));
    }

    public function destroy(NoticesRepository $notices, $id)
    {
        return back()->with('success', $notices->destroy($id));
    }
}
