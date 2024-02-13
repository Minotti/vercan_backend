<?php

namespace App\Modules\Auth\Providers;

use App\Modules\Core\Providers\ModuleServiceProvider;

class AuthServiceProvider extends ModuleServiceProvider
{
    protected string $moduleName = 'Auth';
    protected string $routePrefix = 'auth';
}
