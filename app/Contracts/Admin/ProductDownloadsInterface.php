<?php

namespace App\Contracts\Admin;

interface ProductDownloadsInterface
{
    public function get();

    public function take();

    public static function store($request);
}

