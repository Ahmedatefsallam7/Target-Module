<?php

namespace Modules\Targets\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Users\Transformers\UserResource;

class TargetResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "title" => $this->title,
            "description" => $this->description,
            "type" => $this->type,
            "duration" => $this->duration,
            "amount" => $this->amount,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "user" => new UserResource($this->user)
        ];
    }
}