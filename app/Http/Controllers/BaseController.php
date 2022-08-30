<?php

namespace App\Http\Controllers;

use App\Core\Request;

class BaseController
{
    public Request $request;

    public function __construct()
    {
        $this->request = Request::capture();
    }
}