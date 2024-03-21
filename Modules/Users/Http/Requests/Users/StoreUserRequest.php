<?php

namespace Modules\Users\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'users' => 'required|array',
            "users.*.name" => "required|string|min:3",
            "users.*.email" => "required|email|unique:users,email",
            'users.*.phone' => 'nullable|string|regex:/^\+?(\d{1,3})?[-. ]?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/|min:10|max:15|unique:users,phone',
            'users.*.department' => 'required|string'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
