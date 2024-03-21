<?php

namespace Modules\Targets\Http\Controllers\Actions\TargetAchievement;

use Modules\Targets\Entities\TargetAchievement;

class DestroyTargetAchievementAction
{
    function execute($id)
    {
        // Get Target
        $target = TargetAchievement::destroy($id);

        // return
        return true;
    }
}
