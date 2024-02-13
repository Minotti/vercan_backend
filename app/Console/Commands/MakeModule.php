<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;

class MakeModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module for Vercan structure';

    /**
     * Stubies path
     *
     * @var string
     */
    private string $stubPath = 'stubs/';

    /**
     * Module base path
     *
     * @var string
     */
    private string $modulesBasePath = 'app/Modules/';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $fileSystem = app(Filesystem::class);

        $moduleStructure = $this->getModuleStructure();

        foreach ($moduleStructure as $item) {
            $realFilePath = $this->moduleBasePath() . '/' . $item['file'];
            $this->makeDirectory(dirname($realFilePath));

            if (!$fileSystem->exists($realFilePath)) {
                $contents = $this->getSourceFile($item['stub']);
                $fileSystem->put($realFilePath, $contents);
                $this->info('File: ' . $realFilePath . ' created.');
            } else {
                $this->error('File: ' . $realFilePath . ' alredy exists.');
            }
        }
    }

    /**
     * Gets a stub content and replace the content with the real variable values.
     *
     * @param string $stubPath
     * @return string
     */
    public function getSourceFile(string $stubPath): string
    {
        return $this->getStubContents($stubPath, $this->getStubVariables());
    }

    /**
     * Returns a basic estructure for a module creation
     *
     * @return array
     */
    private function getModuleStructure(): array
    {
        return [
            [
                'stub' => $this->getPathStubFile('config.stub'),
                'file' => 'Config/'. Str::lower($this->getSingularModuleName()).'.php'
            ],

            [
                'stub' => $this->getPathStubFile('ModuleController.stub'),
                'file' => 'Http/Controllers/' . $this->getSingularModuleName() . 'Controller.php',
            ],

            [
                'stub' => $this->getPathStubFile('Api.stub'),
                'file' => 'Http/routes/api.php',
            ],
            [
                'stub' => $this->getPathStubFile('ModuleServiceProvider.stub'),
                'file' => 'Providers/' . $this->getSingularModuleName() . 'ServiceProvider.php',
            ],
            [
                'stub' => $this->getPathStubFile('Resource.stub'),
                'file' => 'Http/Resources/' .  $this->getSingularModuleName() . 'Resource.php',
            ],
            [
                'stub' => $this->getPathStubFile('Service.stub'),
                'file' => 'Services/' .  $this->getSingularModuleName() . 'Service.php',
            ],
            [
                'stub' => $this->getPathStubFile('Repository.stub'),
                'file' => 'Repositories/' .  $this->getSingularModuleName() . 'Repository.php',
            ],
            [
                'stub' => $this->getPathStubFile('Request.stub'),
                'file' => 'Http/Requests/' .  $this->getSingularModuleName() . 'Request.php',
            ]
        ];
    }

    /**
     * Returns the modules base path
     *
     * @return string
     */
    private function moduleBasePath(): string
    {
        return $this->modulesBasePath . $this->getSingularModuleName();
    }

    /**
     *
     * @return array
     */
    private function getStubVariables(): array
    {
        $moduleName = $this->getSingularModuleName();
        $routePrefix = Str::lower($this->getPluralModuleName());
        $namespace = "App\\Modules\\{$moduleName}";

        return [
            'NAMESPACE' => $namespace,
            'MODULE_NAME' => $moduleName,
            'MODULE_NAME_LOWER' => Str::lower($moduleName),
            'ROUTE_PREFIX' => $routePrefix
        ];
    }

    /**
     * Return the path given stub
     *
     * @param string $stubName
     * @return string
     */
    private function getPathStubFile(string $stubName)
    {
        return $this->stubPath . $stubName;
    }

    /**
     * Returns the singular module name
     *
     * @return string
     */
    private function getSingularModuleName(): string
    {
        return ucwords(Pluralizer::singular($this->argument('name')));
    }

    /**
     * Return the plural module name
     *
     * @return string
     */
    private function getPluralModuleName(): string
    {
        return ucwords(Pluralizer::plural($this->argument('name')));
    }

    /**
     * Replace the stub variables by real values.
     *
     * @param $pathStubFile
     * @param array $stubVariables
     * @return string
     */
    private function getStubContents($pathStubFile, array $arrStubVariables): string
    {
        $contents = file_get_contents(base_path($pathStubFile));

        foreach ($arrStubVariables as $variable => $value) {
            if(Str::contains($contents, '$' .$variable. '$')) {
                $contents = str_replace('$' .$variable. '$', $value, $contents);
            }
        }

        return $contents;
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param string $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        $fileSystem = app(Filesystem::class);

        if (!$fileSystem->isDirectory($path)) {
            $fileSystem->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
