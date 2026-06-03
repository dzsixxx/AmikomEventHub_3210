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
        // MENDAFTARKAN ALIAS MIDDLEWARE (Jawaban Soal 8.5 Nomor 3)
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);
        
        // Memaksa redirect ke halaman login admin jika belum auth
        $middleware->redirectGuestsTo('/admin/login');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();