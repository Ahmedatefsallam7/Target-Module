<?php

namespace Modules\Targets\Http\Requests\Target;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreTargetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $now = now()->format('Y-m-d');
        $startDate = Carbon::parse(request()->input('targets.0.start_date'));
        $endDate = Carbon::parse(request()->input('targets.0.end_date'));

        return [
            "targets" => "required|array",
            'targets.*.user_id' => "required|integer|exists:users,id",
            'targets.*.title' => "required|string|min:3|unique:targets,title",
            'targets.*.description' => "nullable|string|min:3",
            'targets.*.type' => "required|string|in:money,calls,meetings,Technical_support_tickets",
            'targets.*.duration' => "required|string|in:daily,urban,every_3_months,semi-annually,annually",
            'targets.*.amount' => "required|numeric|between:0,99999999999.99",
            'targets.*.start_date' => "required|date|after:$now|before_or_equal:$endDate",
            'targets.*.end_date' => "required|date|after_or_equal:$startDate",
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
