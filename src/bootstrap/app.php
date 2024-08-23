<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Helpers\ApiResponseHelper;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
            \App\Http\Middleware\Cors::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponseHelper::error($e->getMessage(), $e->errors(), 422);
            }
        });

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponseHelper::error($e->getMessage(), null, 401);
            }
        });

        $exceptions->render(function (TokenBlacklistedException $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponseHelper::error($e->getMessage(), null, 403);
            }
        });

        $exceptions->render(function (Exception $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponseHelper::error($e->getMessage(), null, 500);
            }
        });
    })->create();
