<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ListingResource;
use App\Models\Listing;
use App\Services\ListingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListingController extends BaseController
{
    private ListingService $listingService;

    public function __construct(ListingService $listingService)
    {
        $this->listingService = $listingService;
    }

    public function index($id)
    {
        $listing = Listing::query()->find($id);

        if (!$listing) {
            return $this->sendError('Not found');
        }

        return $this->sendSuccess('Resource received', ListingResource::make($listing));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:191',
            'description' => 'required|string|',
            'price'       => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error', $validator->errors(), 422);
        }

        $data = $validator->validated();


        $listing = $this->listingService->createListing($data);

        return $this->sendSuccess('Saved successfully', ListingResource::make($listing));
    }
}
