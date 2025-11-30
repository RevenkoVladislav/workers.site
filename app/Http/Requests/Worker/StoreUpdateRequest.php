<?php

namespace App\Http\Requests\Worker;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'email' => [
                'required',
                'email',
                $this->isMethod('post')
                    ? 'unique:users,email'
                    : Rule::unique('users', 'email')->ignore($this->worker->user_id)
                //игнорировать email привязанного пользователя
            ],
            'phone' => [
                'required',
                'string',
                'regex:/^8[0-9]{10}$/',
                $this->isMethod('post')
                    ? 'unique:workers,phone'
                    : Rule::unique('workers', 'phone')->ignore($this->route('worker'))
            ],
            'description' => 'nullable|string|max:1000',
            'is_married' => 'nullable|boolean'
        ];
    }
}
