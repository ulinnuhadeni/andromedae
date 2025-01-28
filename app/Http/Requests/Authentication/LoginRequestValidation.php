<?php

namespace App\Http\Requests\Authentication;

use App\Http\Requests\BaseRequestValidation;

class LoginRequestValidation extends BaseRequestValidation
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
}
