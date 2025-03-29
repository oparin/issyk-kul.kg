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
    public function __construct(private readonly ListingService $listingService) {}

    public function index(): JsonResponse
    {
        $listing = Listing::paginate();

        return $this->sendSuccess('Listings retrieved successfully', ListingResource::collection($listing));
    }

    public function store(CreateListingRequest $request): JsonResponse
    {
        $data = $request->validated();

        $listing = $this->listingService->createListing($data);

        return $this->sendSuccess('Listing created successfully', ListingResource::make($listing));
    }

    public function show(Listing $listing): JsonResponse
    {
        $listing->increment('views');

        return $this->sendSuccess('Listing retrieved successfully', ListingResource::make($listing));
    }

    public function update(UpdateListingRequest $request, Listing $listing): JsonResponse
    {
        $data = $request->validated();

        $listing = $this->listingService->updateListing($listing, $data);

        return $this->sendSuccess('Listing updated successfully', ListingResource::make($listing));
    }

    public function destroy(Listing $listing): JsonResponse
    {
        if (!$listing->delete()) {
            return $this->sendError('Failed to delete the listing', 500);
        }

        return $this->sendSuccess('Listing deleted successfully', ListingResource::make($listing));
    }
}
