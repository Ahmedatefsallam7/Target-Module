<?php

namespace Modules\Targets\Http\Controllers\Actions\TargetAchievement;

use Modules\Targets\Entities\TargetAchievement;
use Modules\Targets\Transformers\TargetAchievementResource;

class GetTargetAchievementByIdAction
{
    function execute($id)
    {
        // Get Target
        $target = TargetAchievement::find($id);

        // return
        return new TargetAchievementResource($target);
    }
}
