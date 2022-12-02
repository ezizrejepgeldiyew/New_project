<?php

namespace App\Repository\Admin;

use App\Contracts\Admin\MoneyCoursInterface;
use App\Http\Requests\MoneyCoursRequest;
use App\Models\MoneyCours;

class MoneyCoursRepository implements MoneyCoursInterface
{
    public function __construct(MoneyCours $money_cours)
    {
        $this->money_cours = $money_cours;
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
        $money_cours = $this->find($id);
        return $money_cours->update($request->all());
    }

    public function destroy($id)
    {
        return MoneyCours::destroy($id);
    }

    public function update_money($id)
    {
        $money_cours = $this->find($id);
        $money = session()->forget('money');
        $money = session()->get('money', []);
        if (empty($money[$id])) {
            $money[$id] = [
                "id" => $id,
                "price" => $money_cours->price,
                "name" => $money_cours->name,
                "fullname" => $money_cours->fullname,
            ];
        }
        session()->put('money', $money);
        return response()->json($money, 200);
    }

    private function find($id)
    {
        return MoneyCours::find($id);
    }

}


