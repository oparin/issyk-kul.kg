<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HandleModelNotFound
{
    public function handle($request, Closure $next): JsonResponse
    {
        try {
            return $next($request);
        } catch (NotFoundHttpException $exception) {
            return response()->json([
                'message' => 'Запись не найдена',
            ], 404);
        } catch (\Exception $exception) {
            // Ловим все остальные исключения
            return response()->json([
                'message' => 'Произошла ошибка.',
                'error' => $exception->getMessage(),
            ], 500);
        }
    }
}
