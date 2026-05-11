<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

         //  $middleware->validateCsrfTokens(except: [
        //     'stripe/*',     // Excludes all routes starting with stripe/
        //     'webhooks/*',   // Common for external services
        //     '/example-path' // Direct path exclusion
        // ]);

          $middleware->validateCsrfTokens(except: [           
            'register', // Direct path exclusion
            'comment/post/store',
            'commentfree/post',
            'comunidad/post',
            'forum/post',
            'login'
        ]);
        
    //       $middleware->appendToGroup('wallk.validate', [
    //    \App\Http\Middleware\WallkValidate::class       
    // ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
