<?php

namespace App\Repository\Admin;

use App\Contracts\Admin\AboutUsInterface;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsRepository implements AboutUsInterface
{
    public function get()
    {
        return AboutUs::get();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['phone'] = "+993".$data['phone'];
        return AboutUs::create($data);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $data['phone'] = "+993".$data['phone'];
        return $this->find($id)->update($data);
    }

    public function destroy($id)
    {
        return AboutUs::destroy($id);
    }

    public function find($id)
    {
        return AboutUs::find($id);
    }

    public function first()
    {
        return AboutUs::first();
    }
}
