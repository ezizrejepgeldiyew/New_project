<?php

namespace App\Contracts\API;

interface BaseInterface
{
    public function sendResponse($result, $message);
    public function sendError($error, $errorMessages = [], $code = 404);
}
