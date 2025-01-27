<?php

namespace App\Services;

use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function updateListing(int $listingId, array $data): bool
    {
        $listing = Listing::query()->find($listingId);

        if (!$listing) {
            return false;
        }

        return $listing->update($data);
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
