<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GuruMiddleware;
use App\Http\Middleware\ResetPassword;
use App\Http\Middleware\SiswaMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'guru' => GuruMiddleware::class,
            'siswa' => SiswaMiddleware::class,
            'reset_password' => ResetPassword::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
