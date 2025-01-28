<?php

namespace App\Http\Services\Authentication;

use App\Traits\ResponseTrait;

class AuthenticationService
{
    use ResponseTrait;

    public function login(array $request)
    {
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        $attemptLogin = auth()->attempt($credentials);

        if (! $attemptLogin) {
            return $this->failedResponse('Invalid Credentials', 400);
        }

        $accessToken = auth()->user()->createToken(bcrypt($request['email']))->plainTextToken;

        return $this->successResponse('Successfully logged in', 200, [
            'access_token' => $accessToken,
        ]);
    }

    public function currentUser()
    {
        $currentUser = auth()->user();

        return $this->successResponse('Successfully Retrieved Data', 200, [
            'data' => $currentUser,
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->successResponse('Successfully logged out', 200);
    }
}
