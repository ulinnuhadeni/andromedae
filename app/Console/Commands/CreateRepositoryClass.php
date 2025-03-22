<?php

namespace App\Console\Commands;

use App\Traits\ClassGeneratorTrait;
use Illuminate\Console\Command;

class CreateRepositoryClass extends Command
{
    use ClassGeneratorTrait;

    protected $signature = 'create:repository {name}';

    protected $description = 'Create a new repository class with interface and implementation';

    protected $basePrefix = 'App\\Http\\Repositories';

    protected $contractPrefix = 'App\\Http\\Repositories\\Contracts';

    public function handle()
    {
        $name = $this->argument('name');

        if (! $name) {
            return $this->error('Please provide a name for the repository class.');
        }

        $repositoryPath = app_path('Http/Repositories/'.$name.'.php');
        $contractPath = app_path('Http/Repositories/Contracts/'.$name.'Contract.php');

        $repositoryStub = base_path('stubs/repository.stub');
        $contractStub = base_path('stubs/repository.contract.stub');

        $generateContractFile = $this->generateFile(
            $name,
            $contractPath,
            $contractStub,
            $this->contractPrefix
        );

        if (! $generateContractFile) {
            return $this->error('Contract is already exists.');
        }

        $generateRepositoryFile = $this->generateFile(
            $name,
            $repositoryPath,
            $repositoryStub,
            $this->basePrefix,
            $this->contractPrefix
        );

        if (! $generateRepositoryFile) {
            return $this->error('Repository is already exists.');
        }

        return $this->info('Repository and Contract are successfully created.');
    }
}
