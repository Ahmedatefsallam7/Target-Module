<?php

namespace Modules\Targets\Http\Requests\Target;

use Carbon\Carbon;
use Modules\Targets\Entities\Target;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTargetRequest extends FormRequest {
    /**
    * Get the validation rules that apply to the request.
    */

    public function rules(): array {
        $user = Target::find( request()->id );

        $now = now()->format( 'Y-m-d' );
        $startDate = Carbon::parse( request()->input( 'start_date' ) ?? $this->start_date );

        return [
            'id' => 'required|exists:targets,id',
            'user_id' => 'nullable|exists:users,id,deleted_at:NULL',
            'subject' => 'nullable|string|min:3',
            'description' => 'nullable|string|min:3',
            'type' => 'nullable|string|in:money,calls,meetings,Technical_support_tickets',
            'duration' => 'nullable|string|in:daily,urban,every_3_months,semi-annually,annually',
            'amount' => 'nullable|numeric|decimal:0,99999999999.99',
            'start_date' => "nullable|date|after:$now",
            'end_date' => "nullable|date|after_or_equal:$startDate",
        ];
    }

    /**
    * Determine if the user is authorized to make this request.
    */

    public function authorize(): bool {
        return true;
    }
}