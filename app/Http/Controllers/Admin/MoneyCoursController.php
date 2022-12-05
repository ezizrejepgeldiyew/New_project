<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MoneyCoursRequest;
use App\Repository\Admin\MoneyCoursRepository;

class MoneyCoursController extends Controller
{
    public function index(MoneyCoursRepository $moneyCours)
    {
        return view('Admin.Money_Cours.index',['money_cours' => $moneyCours->get()]);
    }

    public function store(MoneyCoursRequest $request, MoneyCoursRepository $moneyCours)
    {
        return back()->with('success',$moneyCours->store($request));
    }

    public function update(MoneyCoursRequest $request, MoneyCoursRepository $moneyCours)
    {
        return redirect()->route('money_cours.index')->with('success', $moneyCours->update($request, request('id')));
    }

    public function destroy($id, MoneyCoursRepository $moneyCours)
    {
        return back()->with('success', $moneyCours->destroy($id));
    }
}
