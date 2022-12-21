<?php

namespace App\Contracts\Admin;

use Illuminate\Http\Request;

interface AboutUsInterface
{
    public function get();

    public function store(Request $request);

    public function update($id, Request $request);

    public function destroy($id);

    public function find($id);

    public function first();
}
