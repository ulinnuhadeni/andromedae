<?php

namespace App\Http\Repositories\Task;

use App\Http\Repositories\BaseRepository as Base;
use App\Http\Repositories\Contracts\Task\TaskRepositoryContract as BaseContract;
use App\Models\Task\Task;

class TaskRepository extends Base implements BaseContract
{
    protected $model;

    public function __construct(Task $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
}
