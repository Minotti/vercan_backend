<?php

namespace App\Modules\Supplier\Providers;

use App\Modules\Core\Providers\ModuleServiceProvider;

class SupplierServiceProvider extends ModuleServiceProvider
{
    protected string $moduleName = 'Supplier';
    protected string $routePrefix = 'suppliers';
}
