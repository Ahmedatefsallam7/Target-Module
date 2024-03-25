<?php

namespace Modules\Targets\Http\Requests\TargetAchievement;

use Illuminate\Foundation\Http\FormRequest;

class GetTargetAchievementByIdRequest extends FormRequest {
    /**
    * Get the validation rules that apply to the request.
    */

    public function rules(): array {
        return [
            'id' => 'required|exists:target_achievements,id,deleted_at,NULL',
        ];
    }

    /**
    * Determine if the user is authorized to make this request.
    */

    public function authorize(): bool {
        return true;
    }
}