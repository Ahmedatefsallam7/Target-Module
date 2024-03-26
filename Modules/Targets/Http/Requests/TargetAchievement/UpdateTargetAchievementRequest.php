<?php

namespace Modules\Targets\Http\Requests\TargetAchievement;

use Modules\Targets\Entities\Target;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Targets\Entities\TargetAchievement;

class UpdateTargetAchievementRequest extends FormRequest {
    /**
    * Get the validation rules that apply to the request.
    */

    public function rules(): array {
        $achievedTarget = TargetAchievement::query()->find( $this->id );

        $amount = Target::where( 'id', $achievedTarget->achievable_id )->value( 'amount' ) ?? null;

        return [
            'id' => 'required|integer|exists:target_achievements,id,deleted_at,NULL',
            'target_id' => 'nullable|integer|exists:targets,id,deleted_at,NULL',
            'achieved_amount' => "required|integer|min:0|lte:$amount",
        ];
    }

    /**
    * Determine if the user is authorized to make this request.
    */

    public function authorize(): bool {
        return true;
    }
}