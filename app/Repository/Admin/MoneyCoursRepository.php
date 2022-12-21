<?php

namespace App\Repository\Admin;

use App\Contracts\Admin\MoneyCoursInterface;
use App\Http\Requests\MoneyCoursRequest;
use App\Models\MoneyCours;

class MoneyCoursRepository implements MoneyCoursInterface
{
    public function __construct(MoneyCours $moneyCours)
    {
        $this->moneyCours = $moneyCours;
    }

    public function get()
    {
        return MoneyCours::get();
    }

    public function store(MoneyCoursRequest $request)
    {
        return MoneyCours::create($request->all());
    }

    public function update(MoneyCoursRequest $request, $id)
    {
        $moneyCours = $this->find($id);
        return $moneyCours->update($request->all());
    }

    public function destroy($id)
    {
        return MoneyCours::destroy($id);
    }

    public function updateMoney($id)
    {
        $moneyCours = $this->find($id);
        $money = session()->forget('money');
        $money[$id] = [
            "id" => $id,
            "price" => $moneyCours->price,
            "name" => $moneyCours->name,
            "fullname" => $moneyCours->fullname,
        ];
        session()->put('money', $money);
        return response()->json($money, 200);
    }

    private function find($id)
    {
        return MoneyCours::find($id);
    }
}
