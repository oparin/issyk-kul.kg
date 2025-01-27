<?php

namespace App\Http\Resources;

use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Listing */
class ListingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'price'       => $this->price,
            'status'      => $this->status,
            'expires_at'  => Carbon::parse($this->expires_at)->format('d/m/Y H:i'),
            'views'       => $this->views,
        ];
    }
}
