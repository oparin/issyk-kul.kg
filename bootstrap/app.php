<?php

use App\Http\Middleware\ForceJson;
use App\Http\Middleware\HandleModelNotFound;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminatech\MultipartMiddleware\MultipartFormDataParser;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->name('api.v1.')
                ->group(base_path('app/Http/API/routes.php'));
//            Route::middleware('api')
//                ->prefix('api/v2')
//                ->name('api.v2.')
//                ->group(base_path('routes/api_v2.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(MultipartFormDataParser::class);
        $middleware->prependToGroup(
            'api',
            [ForceJson::class, HandleModelNotFound::class]
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Record not found'
                ], 404);
            }
        });
    })->create();
