<?php

namespace App\Modules\Location\Providers;

use App\Modules\Core\Providers\ModuleServiceProvider;

class LocationServiceProvider extends ModuleServiceProvider
{
    protected string $moduleName = 'Location';
    protected string $routePrefix = 'locations';
}
