<?php

namespace App\Http\API\Requests\Listing;

use App\Enums\Currency;
use App\Enums\PriceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateListingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'        => ['sometimes', 'string', 'max:191'],
            'description'  => ['sometimes', 'nullable', 'string'],
            'price'        => ['sometimes', 'nullable', 'numeric', 'min:0', 'max:9999999'],
            'currency'     => ['sometimes', 'nullable', new Enum(Currency::class)],
            'price_type'   => ['sometimes', 'nullable', new Enum(PriceType::class)],
            'city_id'      => ['sometimes', 'nullable', 'exists:cities,id'],
            'resort_id'    => ['sometimes', 'nullable', 'exists:resorts,id'],
            'phone'        => ['sometimes', 'nullable', 'string'],
            'has_whatsapp' => ['sometimes', 'nullable', 'boolean'],
            'has_telegram' => ['sometimes', 'nullable', 'boolean'],
            'latitude'     => ['sometimes', 'nullable', 'numeric', 'min:-90', 'max:90'],
            'longitude'    => ['sometimes', 'nullable', 'numeric', 'min:-180', 'max:180'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
