<?php

namespace App\Http\API\Resources;

use App\Enums\PriceType;
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
            'id'           => $this->id,
            'title'        => $this->title,
            'description'  => $this->description,
            'price'        => $this->price
                ? number_format($this->price, 2, '.', '')
                : 'Договорная',
            'currency'     => $this->currency?->alias(),
            'price_type'   => $this->price_type?->alias(),
            'phone'        => $this->phone,
            'has_whatsapp' => $this->has_whatsapp,
            'has_telegram' => $this->has_telegram,
            'latitude'     => $this->latitude,
            'longitude'    => $this->longitude,
            'status'       => $this->status,
            'expires_at'   => Carbon::parse($this->expires_at)->format('d/m/Y H:i'),
            'views'        => $this->views,
        ];
    }
}
