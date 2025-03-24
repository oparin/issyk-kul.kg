<?php

namespace App\Http\API\Services;

use App\Models\Listing;
use Carbon\Carbon;

class ListingService
{
    public function createListing(array $data): Listing
    {
        $user = auth()->user();

        $data['user_id']    = $user->id;
        $data['status']     = 'moderate';
        $data['expires_at'] = Carbon::now()->addDays(30);
        $data['views']      = 0;

        return Listing::query()->create($data);
    }

    public function updateListing(Listing $listing, array $data): Listing
    {
        $listing->update($data);

        return $listing;
    }

    public function archiveExpiredListings(): void
    {
        Listing::query()->where('status', 'active')
            ->where('expires_at', '<', Carbon::now())
            ->update(['status' => 'archived']);
    }

    public function incrementViews(int $listingId): void
    {
        Listing::query()->where('id', $listingId)->increment('views');
    }
}
