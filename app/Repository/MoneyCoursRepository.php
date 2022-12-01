<?php

namespace App\Repository;

use App\Contracts\MoneyCoursInterface;
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

    private function find($id)
    {
        return MoneyCours::find($id);
    }

}


