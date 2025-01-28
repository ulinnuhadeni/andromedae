<?php

namespace App\Exceptions;

use App\Traits\ResponseTrait;
use Exception;

class AuthenticationException extends Exception
{
    use ResponseTrait;

    public function render($request)
    {
        return $this->failedResponse('Unauthorized Access', 401);
    }
}
