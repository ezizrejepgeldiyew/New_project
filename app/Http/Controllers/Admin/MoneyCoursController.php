<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MoneyCoursRequest;
use App\Repository\MoneyCoursRepository;

class MoneyCoursController extends Controller
{
    public function index(MoneyCoursRepository $money_cours)
    {
        return view('Admin.Money_Cours.index',['money_cours' => $money_cours->get()]);
    }

    public function store(MoneyCoursRequest $request, MoneyCoursRepository $money_cours)
    {
        return back()->with('success',$money_cours->store($request));
    }

    public function update(MoneyCoursRequest $request, MoneyCoursRepository $money_cours)
    {
        return redirect()->route('money_cours.index')->with('success', $money_cours->update($request, request('id')));
    }

    public function destroy($id, MoneyCoursRepository $money_cours)
    {
        return back()->with('success', $money_cours->destroy($id));
    }
}
