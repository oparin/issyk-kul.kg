<?php

namespace App\Http\API\Requests\Listing;

use Illuminate\Foundation\Http\FormRequest;

class UpdateListingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'       => ['sometimes', 'string', 'max:191'],
            'description' => ['sometimes', 'string'],
            'price'       => ['sometimes', 'numeric', 'min:0'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
