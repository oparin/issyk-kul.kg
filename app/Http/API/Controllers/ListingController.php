<?php

namespace App\Http\API\Controllers;

use App\Http\API\Requests\Listing\CreateListingRequest;
use App\Http\API\Requests\Listing\UpdateListingRequest;
use App\Http\API\Resources\ListingResource;
use App\Http\API\Services\ListingService;
use App\Models\Listing;
use Illuminate\Http\JsonResponse;

class ListingController extends BaseController
{
    private ListingService $listingService;

    public function __construct(ListingService $listingService)
    {
        $this->listingService = $listingService;
    }

    public function index(): JsonResponse
    {
        $listing = Listing::all();

        return $this->sendSuccess('Resource received', ListingResource::collection($listing));
    }

    public function store(CreateListingRequest $request): JsonResponse
    {
        $data = $request->validated();

        $listing = $this->listingService->createListing($data);

        return $this->sendSuccess('Saved successfully', ListingResource::make($listing));
    }

    public function show(Listing $listing): JsonResponse
    {
        $listing->increment('views');

        return $this->sendSuccess('Resource received', ListingResource::make($listing));
    }

    public function update(UpdateListingRequest $request, Listing $listing): JsonResponse
    {
        $data = $request->validated();

        $listing = $this->listingService->updateListing($listing, $data);

        return $this->sendSuccess('Update successfully', ListingResource::make($listing));
    }

    public function destroy(Listing $listing): JsonResponse
    {
        $listing->delete();

        return $this->sendSuccess('Delete successfully');
    }
}
