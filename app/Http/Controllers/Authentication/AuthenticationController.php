<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequestValidation;
use App\Http\Services\Authentication\AuthenticationService;

class AuthenticationController extends Controller
{
    protected $service;

    public function __construct(AuthenticationService $service)
    {
        $this->service = $service;
    }

    public function login(LoginRequestValidation $request)
    {
        $payload = $request->validated();

        try {
            return $this->service->login($payload);
        } catch (\Throwable $th) {
            return $this->failedResponse($th->getMessage());
        }
    }

    public function currentUser()
    {
        return $this->service->currentUser();
    }

    public function logout()
    {
        try {
            return $this->service->logout();
        } catch (\Throwable $th) {
            return $this->failedResponse($th->getMessage());
        }
    }
}
