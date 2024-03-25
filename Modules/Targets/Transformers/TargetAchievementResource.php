<?php

namespace Modules\Targets\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Targets\Transformers\TargetResource;

class TargetAchievementResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request): array
    {
        return  [
            "id" => $this->id,
            'user_id' => $this->user_id,
            'target_id' => $this->target_id,
            'achieved_amount' => $this->achieved_amount,
            "percentage" => $this->percentage . " %",
            "target" => new TargetResource($this->target),
        ];
    }
}
