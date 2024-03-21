<?php

namespace Modules\Targets\Http\Requests\TargetAchievement;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Targets\Entities\TargetAchievement;

class UpdateTargetAchievementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $achievedTarget = TargetAchievement::query()->find($this->id);

        $amount =  $achievedTarget->target->amount ?? null;

        return [
            "id" => 'required|integer|exists:target_achievements,id',
            'user_id' => 'nullable|integer|exists:users,id',
            'target_id' => 'nullable|integer|exists:targets,id',
            "achieved_amount" => "required|numeric|min:0|lte:$amount",
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
