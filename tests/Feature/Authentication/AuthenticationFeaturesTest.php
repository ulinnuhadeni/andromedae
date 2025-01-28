<?php

namespace Tests\Feature\Authentication;

use Tests\TestCase;

class AuthenticationFeaturesTest extends TestCase
{
    protected $payloads = [
        'email' => '',
        'password' => '',
    ];

    protected $routes = [
        'login' => 'api.auth.login',
        'current-user' => 'api.auth.current-user',
        'logout' => 'api.auth.logout',
    ];

    public function test_user_can_not_login_without_empty_email_input(): void
    {
        $service = $this->mockPostRequest($this->routes['login'], $this->payloads);
        $response = $service->json();

        $service->assertStatus(400);
        $this->assertArrayHasKey('errors', $response);
        $this->assertEquals(false, $response['success']);
        $this->assertEquals('The email field is required.', $response['errors']);
    }

    public function test_user_can_not_login_with_invalid_email_address_format(): void
    {
        $payloads = $this->payloads;
        $payloads['email'] = 'test';

        $service = $this->mockPostRequest($this->routes['login'], $payloads);
        $response = $service->json();

        $service->assertStatus(400);
        $this->assertArrayHasKey('errors', $response);
        $this->assertEquals(false, $response['success']);
        $this->assertEquals('The email field must be a valid email address.', $response['errors']);
    }

    public function test_user_can_not_login_with_empty_password_input(): void
    {
        $payloads = $this->payloads;
        $payloads['email'] = 'tester-email@mailinator.com';

        $service = $this->mockPostRequest($this->routes['login'], $payloads);
        $response = $service->json();

        $service->assertStatus(400);
        $this->assertArrayHasKey('errors', $response);
        $this->assertEquals(false, $response['success']);
        $this->assertEquals('The password field is required.', $response['errors']);
    }

    public function test_user_can_not_login_with_invalid_credentials(): void
    {
        $payloads = $this->payloads;
        $payloads['email'] = 'tester-email@mailinator.com';
        $payloads['password'] = 'testeradminabcdef';

        $service = $this->mockPostRequest($this->routes['login'], $payloads);
        $response = $service->json();

        $service->assertStatus(400);
        $this->assertArrayHasKey('errors', $response);
        $this->assertEquals(false, $response['success']);
        $this->assertEquals('Invalid Credentials', $response['errors']);
    }

    public function test_user_can_login_with_valid_credentials(): void
    {
        $payloads = $this->payloads;
        $payloads['email'] = 'tester-email@mailinator.com';
        $payloads['password'] = 'tester1234';

        $service = $this->mockPostRequest($this->routes['login'], $payloads);
        $response = $service->json();

        $service->assertStatus(200);
        $this->assertEquals(true, $response['success']);
        $this->assertArrayHasKey('access_token', $response);
    }

    public function test_user_can_get_current_user_data(): void
    {
        $payloads = $this->payloads;
        $payloads['email'] = 'tester-email@mailinator.com';
        $payloads['password'] = 'tester1234';

        $loginService = $this->mockPostRequest($this->routes['login'], $payloads);

        $service = $this->mockGetRequest($this->routes['current-user'], [
            'Authorization' => 'Bearer '.$loginService->json()['access_token'],
        ]);

        $response = $service->json();

        $service->assertStatus(200);
        $this->assertArrayHasKey('data', $response);
        $this->assertEquals(true, $response['success']);
        $this->assertEquals($payloads['email'], $response['data']['email']);
        $this->assertEquals('Successfully Retrieved Data', $response['message']);
    }

    public function test_user_can_logout(): void
    {
        $payloads = $this->payloads;
        $payloads['email'] = 'tester-email@mailinator.com';
        $payloads['password'] = 'tester1234';

        $loginService = $this->mockPostRequest($this->routes['login'], $payloads);

        $service = $this->mockGetRequest($this->routes['logout'], [
            'Authorization' => 'Bearer '.$loginService->json()['access_token'],
        ]);

        $response = $service->json();

        $service->assertStatus(200);

        $this->assertEquals(true, $response['success']);
        $this->assertEquals('Successfully logged out', $response['message']);
    }
}
