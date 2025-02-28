<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register the 'role' middleware globally or for certain routes
        $middleware->add(\App\Http\Middleware\RoleMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Add custom exception handling if needed
    })
    ->create();
