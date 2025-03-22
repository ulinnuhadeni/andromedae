<?php

namespace App\Http\Services\Task;

use App\Http\Repositories\Contracts\Task\TaskRepositoryContract;
use App\Http\Resources\Task\TaskResource;
use App\Http\Services\BaseService as Base;

class TaskService extends Base
{
    protected $repository;

    protected $responseMessages = [
        'index-success' => 'Tasks has been successfully fetched.',
        'store-success' => 'Task has been successfully created.',
        'show-success' => 'Task has been successfully retrieved.',
        'update-success' => 'Task has been successfully updated.',
        'destroy-success' => 'Task has been successfully deleted.',
    ];

    public function __construct(TaskRepositoryContract $repository)
    {
        parent::__construct($repository, new TaskResource([]));
        $this->repository = $repository;
    }
}
