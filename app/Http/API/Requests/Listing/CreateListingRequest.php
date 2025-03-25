<?php

namespace App\Http\API\Requests\Listing;

use Illuminate\Foundation\Http\FormRequest;

class CreateListingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:191'],
            'description'  => ['required', 'string'],
            'price'        => ['required', 'numeric', 'min:0'],
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
