<?php

namespace App\Contracts\User;

interface StoreInterface
{
    public function searchFilter();

    public function priceFilter();

    public function checkboxFilter();
}

