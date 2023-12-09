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
            'name' => ['nullable', 'string', 'min:4', 'max:255'],
            'price' => ['nullable', 'array'],
            'price.*' => ['integer', 'min:0', 'max:4294967295'],
            'bedrooms' => ['nullable', 'integer', 'max:255'],
            'bathrooms' => ['nullable', 'integer', 'max:255'],
            'storeys' => ['nullable', 'integer', 'max:255'],
            'garages' => ['nullable', 'integer', 'max:255']
        ];
    }

    public function attributes()
    {
        return [
            'price.0' => 'min',
            'price.1' => 'max',
        ];
    }
}
