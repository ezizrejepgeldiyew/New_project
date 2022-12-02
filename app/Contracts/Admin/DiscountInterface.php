<?php

namespace App\Contracts\Admin;

interface DiscountInterface
{
    public function get();

    public function create();

    public function store();
}
