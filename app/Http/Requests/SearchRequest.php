<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'array', 'max:4294967295'],
            'bedrooms' => ['nullable', 'integer', 'max:255'],
            'bathrooms' => ['nullable', 'integer', 'max:255'],
            'storeys' => ['nullable', 'integer', 'max:255'],
            'garages' => ['nullable', 'integer', 'max:255']
        ];
    }
}