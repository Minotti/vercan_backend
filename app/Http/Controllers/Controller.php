<?php

namespace App\Http\Controllers;

use App\Modules\Core\Traits\HttpResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use HttpResponseTrait, AuthorizesRequests, ValidatesRequests;
}
