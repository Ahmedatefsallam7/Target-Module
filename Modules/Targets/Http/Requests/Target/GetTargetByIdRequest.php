<?php

namespace Modules\Targets\Http\Requests\Target;

use Illuminate\Foundation\Http\FormRequest;

class GetTargetByIdRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "id" => "required|exists:targets,id",
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
