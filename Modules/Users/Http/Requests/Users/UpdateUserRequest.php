<?php

namespace Modules\Users\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest {
    /**
    * Get the validation rules that apply to the request.
    */

    public function rules(): array {
        return [
            'id' => 'required|integer|exists:users,id,deleted_at,NULL',
            'name' => 'nullable|string|min:3',
            'email' => "nullable|email|unique:users,email,$this->id",
            'phone' => "nullable|string|regex:/^\+?(\d{1,3})?[-. ]?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/|min:10|max:15|unique:users,phone,$this->id",
            'department' => 'nullable|string'
        ];
    }

    /**
    * Determine if the user is authorized to make this request.
    */

    public function authorize(): bool {
        return true;
    }
}