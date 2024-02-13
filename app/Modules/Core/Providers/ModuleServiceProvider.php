<?php

namespace App\Modules\Core\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class ModuleServiceProvider extends ServiceProvider
{
    protected string $moduleName = '';
    protected string $routePrefix = '';

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerRoutes();
    }

    /**
     * Register all configs from modules
     * @return void
     */
    public function registerConfig(): void
    {
        $this->mergeConfigFrom(
            app_path('Modules/' . ucfirst($this->moduleName) . "/Config/{$this->moduleNameSnakeCase()}.php"),
            "module.{$this->moduleNameSnakeCase()}"
        );
    }

    /**
     * Register all routes from modules
     * @return void
     */
    public function registerRoutes(): void
    {
        Route::prefix("/api/{$this->routePrefix}")
            ->middleware(['api'])
            ->name("app.{$this->moduleNameSnakeCase()}.")
            ->namespace('App\\Modules\\' . ucfirst($this->moduleName) . '\\Http\\Controllers')
            ->group(app_path('Modules/' . ucfirst($this->moduleName) . '/Http/routes/api.php'));
    }

    /**
     * Returns the module name on snake_case format.
     *
     * @return string
     */
    private function moduleNameSnakeCase(): string
    {
        return Str::snake($this->moduleName);
    }
}
