<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware;  // Import the RoleMiddleware class

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register the middleware here
        $middleware->addGlobal(RoleMiddleware::class);  // This adds the role middleware globally, if needed
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
