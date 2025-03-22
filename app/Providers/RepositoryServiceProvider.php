<?php

namespace App\Providers;

use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\Contracts\BaseRepositoryContract;
use App\Http\Repositories\Contracts\Task\TaskRepositoryContract;
use App\Http\Repositories\Task\TaskRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        BaseRepositoryContract::class => BaseRepository::class,
        TaskRepositoryContract::class => TaskRepository::class,
    ];

    public function register(): void
    {
        foreach ($this->repositories as $interface => $class) {
            $this->app->bind($interface, $class);
        }
    }
}
