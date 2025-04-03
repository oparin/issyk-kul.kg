<?php

namespace App\Repositories;

use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ListingRepository
{
    public function getAll(): Collection
    {
        return Listing::all();
    }

    public function getPaginatedListings(int $perPage = 15): LengthAwarePaginator
    {
        return Listing::paginate($perPage);
    }

    public function create(array $data): Listing
    {
        return Listing::create($data);
    }

    public function getById($id): ?Listing
    {
        return Listing::find($id);
    }

    public function update(Listing $listing, array $data): Listing
    {
        $listing->update($data);

        return $listing;
    }

    public function delete(Listing $listing): bool
    {
        return $listing->delete();
    }

    public function archiveExpiredListings(): void
    {
        Listing::query()
            ->where('status', 'active')
            ->where('expires_at', '<', Carbon::now())
            ->update(['status' => 'archived']);
    }
}
