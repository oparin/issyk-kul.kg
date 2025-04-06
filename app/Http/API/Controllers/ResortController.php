<?php

namespace App\Http\API\Controllers;

use App\Http\API\Resources\ResortResource;
use App\Models\Resort;
use Illuminate\Http\JsonResponse;

class ResortController extends BaseController
{
    public function index(): JsonResponse
    {
        return $this->sendSuccess('Resorts retrieved successfully', ResortResource::collection(Resort::all()));
    }
}
