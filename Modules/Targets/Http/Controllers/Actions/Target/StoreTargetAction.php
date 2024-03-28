<?php

namespace Modules\Targets\Http\Controllers\Actions\Target;

use Illuminate\Support\Facades\DB;
use Modules\Targets\Entities\Target;
use Modules\Targets\Entities\TargetAchievement;
use Modules\Targets\Transformers\TargetResource;

class StoreTargetAction
{
    public function execute($data)
    {
        $targets = [];

        DB::transaction(function () use ($data, &$targets) {
            foreach ($data['targets'] as $targetData) {
                $newTarget = $this->createTarget($targetData);
                $this->createTargetAchievement($newTarget);
                $targets[] = new TargetResource($newTarget);
            }
        });

        return $targets;
    }

    private function createTarget($targetData)
    {
        return Target::create([
            "targetable_type" => "Modules\Users\Entities\User",
            "targetable_id" => $targetData["user_id"],
            "subject" => $targetData["subject"],
            "description" => $targetData["description"],
            "type" => $targetData["type"],
            "duration" => $targetData["duration"],
            "amount" => $targetData["amount"],
            "start_date" => $targetData["start_date"],
            "end_date" => $targetData["end_date"] ?? null,
        ]);
    }

    private function createTargetAchievement($newTarget)
    {
        TargetAchievement::create([
            "achievable_type" => "Modules\Targets\Entities\Target",
            "achievable_id" => $newTarget->id,
        ]);
    }
}
