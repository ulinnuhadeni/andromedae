<?php

namespace Tests\Feature\Task;

use App\Models\Task\Task;
use Tests\TestCase;

class BaseFeatureTest extends TestCase
{
    protected $routes = [
        'get-tasks' => 'api.task.index',
        'find-task' => 'api.task.show',
        'store-task' => 'api.task.store',
        'update-task' => 'api.task.update',
        'delete-task' => 'api.task.destroy',
    ];

    public function setUp(): void
    {
        parent::setUp();

        $this->mockLoggedInUser('tester-email@mailinator.com');

        Task::create([
            'title' => 'Test Task',
            'description' => 'Test Description',
            'start_date' => now(),
            'end_date' => now()->addDay(),
        ]);
    }
}
