<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Passport\Exceptions\OAuthServerException;
use Laravel\Passport\Exceptions\AuthenticationException;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'client' => CheckClientCredentials::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
        $exceptions->render(function (Throwable $exception, Request $request) {

            if ($exception instanceof OAuthServerException || $exception instanceof AuthenticationException) {
                return response()->json(
                    [
                    "code" => "UNAUTHORIZED_ACCESS",
                    "message" => "Unauthorized access for the requested content."
                    ]
                    , 401);
            }
        });
    })->create();
