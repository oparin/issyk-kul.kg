<?php

namespace App\Http\API\Controllers;

use App\Http\API\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class CityController extends BaseController
{
    public function index(): JsonResponse
    {
        return $this->sendSuccess('Cities retrieved successfully', CityResource::collection(City::all()));
    }
}
