<?php

namespace App\Contracts;

interface ProductDownloadsInterface
{
    public function get();

    public static function store($request);
}

