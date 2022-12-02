<?php

namespace App\Contracts\Admin;

interface OrderInterface
{
    public function store();

    public function count();

    public function status();

    public function true();

    public function false();

    public function changestatus();
}

