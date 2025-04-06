<?php

namespace App\Http\API\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseController extends Controller
{
    public function sendSuccess($message, $data = [], $code = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data'    => $data
        ], $code);
    }

    public function responsePaginated(string $message, AnonymousResourceCollection|LengthAwarePaginator $resource): JsonResponse
    {
        /** @var LengthAwarePaginator $paginator */
        if ($resource instanceof AnonymousResourceCollection) {
            $paginator = $resource->resource;
        } else {
            $paginator = $resource;
        }

        return response()->json([
            'message'    => $message,
            'data'       => $paginator->items(),
            'pagination' => [
                'per_page'    => $paginator->perPage(),
                'page'        => $paginator->currentPage(),
                'total_page'  => $paginator->lastPage(),
                'total_items' => $paginator->total(),
            ]
        ], 200);
    }

    public function sendError($message, $data = null, $code = 404): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'errors'  => $data
        ], $code);
    }
}
