<?php

namespace App\Contracts;

interface DiscountInterface
{
    public function get();

    public function create();

    public function store();
}
