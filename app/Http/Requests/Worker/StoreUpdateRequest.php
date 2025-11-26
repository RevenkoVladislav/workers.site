<?php

namespace App\Http\Requests\Worker;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:60',
            'surname' => 'nullable|string|max:90',
            'age' => 'nullable|integer|between:18,100',
            'email' => 'required|email',
            'phone' => 'required|string|regex:/^8[0-9]{10}$/',
            'description' => 'nullable|string|max:1000',
            'is_married' => 'nullable|boolean'
        ];
    }
}
