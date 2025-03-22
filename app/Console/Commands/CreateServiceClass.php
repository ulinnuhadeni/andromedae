<?php

namespace App\Console\Commands;

use App\Traits\ClassGeneratorTrait;
use Illuminate\Console\Command;

class CreateServiceClass extends Command
{
    use ClassGeneratorTrait;

    protected $signature = 'create:service {name}';

    protected $description = 'Create a new service class';

    protected $basePrefix = 'App\\Http\\Services';

    public function handle()
    {
        $name = $this->argument('name');

        if (! $name) {
            return $this->error('Please provide a name for the service class.');
        }

        $servicePath = app_path('Http/Services/'.$name.'.php');
        $serviceStub = base_path('stubs/service.stub');

        $generateServiceFile = $this->generateFile(
            $name,
            $servicePath,
            $serviceStub,
            $this->basePrefix
        );

        if (! $generateServiceFile) {
            return $this->error('Service class is already exists.');
        }

        return $this->info('Service class successfully created.');
    }
}
