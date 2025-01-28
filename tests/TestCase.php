<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function mockPostRequest($routeName, $payloads)
    {
        return $this->post(route($routeName), $payloads);
    }

    protected function mockGetRequest($routeName, $headers = [])
    {
        return $this->get(route($routeName), $headers);
    }
}
