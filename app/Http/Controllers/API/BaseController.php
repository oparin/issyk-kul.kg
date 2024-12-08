<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function sendSuccess($message, $data = [], $code = 200)
    {
        return response()->json([
            'message' => $message,
            'data'    => $data
        ], $code);
    }

    public function sendError($message, $data = null, $code = 404)
    {
        return response()->json([
            'message' => $message,
            'errors'  => $data
        ], $code);
    }
}
