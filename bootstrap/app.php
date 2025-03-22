<?php

use App\Exceptions\AuthenticationException as AppAuthenticationException;
use App\Http\Middleware\ForceJSONRequestHeader;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(ForceJSONRequestHeader::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->map(AuthenticationException::class, AppAuthenticationException::class);
    })->create();
