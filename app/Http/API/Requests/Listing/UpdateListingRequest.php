<?php

namespace App\Http\API\Requests\Listing;

use Illuminate\Foundation\Http\FormRequest;

class UpdateListingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'        => ['sometimes', 'string', 'max:191'],
            'description'  => ['sometimes', 'string'],
            'price'        => ['sometimes', 'numeric', 'min:0', 'max:9999999'],
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
