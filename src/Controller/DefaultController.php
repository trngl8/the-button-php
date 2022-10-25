<?php

namespace App\Controller;

use Buki\Router\Http\Controller;

class DefaultController extends Controller
{
    public function api()
    {
        return ['result' => true];
    }
}
