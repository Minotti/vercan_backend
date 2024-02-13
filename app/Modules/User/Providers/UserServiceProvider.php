<?php

namespace App\Modules\User\Providers;

use App\Modules\Core\Providers\ModuleServiceProvider;

class UserServiceProvider extends ModuleServiceProvider
{
    protected string $moduleName = 'User';
    protected string $routePrefix = 'users';
}
