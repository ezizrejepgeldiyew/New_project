<?php

namespace App\Contracts\User;

interface StoreInterface
{
    public function search_filter();

    public function price_filter();

    public function checkbox_filter();
}

