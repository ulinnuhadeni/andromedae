<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    protected function mockLoggedInUser($email)
    {
        $user = User::where('email', $email)->first();

        Sanctum::actingAs($user);
    }

    protected function mockPostRequest($routeName, $payloads)
    {
        return $this->post(route($routeName), $payloads);
    }

    protected function mockGetRequest($routeName, $headers = [])
    {
        return $this->get(route($routeName), $headers);
    }

    protected function mockFindRequest($routeName, $id)
    {
        return $this->get(route($routeName, $id));
    }

    protected function mockPutRequest($routeName, $id, $payloads)
    {
        return $this->put(route($routeName, $id), $payloads);
    }

    protected function mockPatchRequest($routeName, $id, $payloads)
    {
        return $this->patch(route($routeName, $id), $payloads);
    }

    protected function mockDeleteRequest($routeName, $id)
    {
        return $this->delete(route($routeName, $id));
    }
}
