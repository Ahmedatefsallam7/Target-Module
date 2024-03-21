<?php

namespace Modules\Users\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class GetUserByIdRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "id" => 'required|integer|exists:users,id',
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
