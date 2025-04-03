<?php

namespace App\Http\API\Services;

use App\Models\Listing;
use App\Repositories\ListingRepository;
use Illuminate\Pagination\LengthAwarePaginator;

readonly class ListingService
{
    public function __construct(private ListingRepository $listingRepository) {}

    public function getPaginatedListings(int $perPage = 15): LengthAwarePaginator
    {
        return $this->listingRepository->getPaginatedListings($perPage);
    }

    public function createListing(array $data): Listing
    {
        return $this->listingRepository->create(array_merge($data, [
            'user_id'    => auth()->id(),
            'status'     => 'moderate',
            'expires_at' => now()->addDays(30),
            'views'      => 0,
        ]));
    }

    public function updateListing(Listing $listing, array $data): Listing
    {
        return $this->listingRepository->update($listing, $data);
    }

    public function deleteListing(Listing $listing): bool
    {
        return $this->listingRepository->delete($listing);
    }

    public function archiveExpiredListings(): void
    {
        $this->listingRepository->archiveExpiredListings();
    }
}
