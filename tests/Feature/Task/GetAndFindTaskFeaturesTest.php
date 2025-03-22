<?php

namespace Tests\Feature\Task;

use App\Models\Task\Task;

class GetAndFindTaskFeaturesTest extends BaseFeatureTest
{
    public function test_authenticated_user_can_get_all_tasks(): void
    {
        $service = $this->mockGetRequest($this->routes['get-tasks']);

        $response = $service->json();

        $service->assertStatus(200);
        $this->assertArrayHasKey('data', $response);
        $this->assertEquals(true, $response['success']);
        $this->assertEquals(count($response['data']), Task::count());
        $this->assertEquals('Tasks has been successfully fetched.', $response['message']);
    }

    public function test_authenticated_user_can_find_specific_task(): void
    {
        $task = Task::first();

        $service = $this->mockFindRequest($this->routes['find-task'], $task->id);

        $response = $service->json();

        $service->assertStatus(200);
        $this->assertArrayHasKey('data', $response);
        $this->assertEquals(true, $response['success']);
        $this->assertEquals('Task has been successfully retrieved.', $response['message']);
    }

    public function test_unauthenticated_user_cannot_get_all_tasks(): void
    {
        $this->refreshApplication();

        $service = $this->mockGetRequest($this->routes['get-tasks']);

        $response = $service->json();

        $service->assertStatus(401);
        $this->assertEquals(false, $response['success']);
        $this->assertEquals('Unauthorized Access', $response['errors']);
    }

    public function test_unauthenticated_user_cannot_find_specific_task(): void
    {
        $this->mockLoggedInUser();

        $task = Task::first();

        $service = $this->mockFindRequest($this->routes['find-task'], $task->id);

        $response = $service->json();
        dd($response);
        $service->assertStatus(401);
        $this->assertEquals(false, $response['success']);
        $this->assertEquals('Unauthorized Access', $response['errors']);
    }
}
