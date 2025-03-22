<?php

namespace App\Traits;

use Illuminate\Filesystem\Filesystem;

trait ClassGeneratorTrait
{
    protected Filesystem $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    protected function makeDirectory(string $path)
    {
        $directory = dirname($path);

        if (! $this->files->isDirectory($directory)) {
            $this->files->makeDirectory($directory, 0755, true);
        }
    }

    protected function replacePlaceholders(
        string $stub,
        string $name,
        string $prefix,
        ?string $contractBaseNamespace = null
    ): string {

        $namespace = $this->generateNamespace($name, $prefix);
        $className = $this->generateClassName($name);

        $result = str_replace(
            ['{{ namespace }}', '{{ className }}'],
            [$namespace, $className],
            $stub
        );

        if ($contractBaseNamespace) {

            $contractNamespace = $contractBaseNamespace ?
                $this->generateNamespace($name, $contractBaseNamespace) : '';

            $contractClassName = $className.'Contract';

            $result = str_replace(
                [
                    '{{ namespace }}',
                    '{{ className }}',
                    '{{ contractNamespace }}',
                    '{{ contractClassName }}',
                ],
                [
                    $namespace,
                    $className,
                    $contractNamespace,
                    $contractClassName,
                ],
                $stub
            );
        }

        return $result;
    }

    protected function convertToNamespace(string $name): string
    {
        $parts = explode('/', $name);

        return '\\'.implode('\\', $parts);
    }

    protected function generateNamespace(string $name, string $baseNamespace): string
    {
        $parts = explode('/', $name);
        array_pop($parts);

        $namespacePath = implode('\\', $parts);

        return $baseNamespace.($namespacePath ? '\\'.$namespacePath : '');
    }

    protected function generateClassName(string $name): string
    {
        $parts = explode('/', $name);

        return array_pop($parts);
    }

    protected function generateFile(
        string $name,
        string $filePath,
        string $stubFilePath,
        string $prefix,
        ?string $contractPrefix = null
    ): bool {

        if ($this->files->exists($filePath)) {
            return false;
        }

        // Create folders if not exist
        $this->makeDirectory($filePath);

        // Generate file
        $stub = $this->files->get($stubFilePath);

        $fileContent = $this->replacePlaceholders($stub, $name, $prefix);

        if ($contractPrefix) {
            $fileContent = $this->replacePlaceholders($stub, $name, $prefix, $contractPrefix);
        }

        $this->files->put($filePath, $fileContent);

        return true;
    }
}
