<?php

namespace App\Http\API\Requests\Listing;

use App\Enums\Currency;
use App\Enums\PriceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateListingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:191'],
            'description'  => ['required', 'string'],
            'price'        => ['required', 'numeric', 'min:0', 'max:9999999'],
            'currency'     => ['sometimes', 'nullable', new Enum(Currency::class)],
            'price_type'   => ['sometimes', 'nullable', new Enum(PriceType::class)],
            'phone'        => ['sometimes', 'string'],
            'has_whatsapp' => ['sometimes', 'boolean'],
            'has_telegram' => ['sometimes', 'boolean'],
            'latitude'     => ['sometimes', 'string'],
            'longitude'    => ['sometimes', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
