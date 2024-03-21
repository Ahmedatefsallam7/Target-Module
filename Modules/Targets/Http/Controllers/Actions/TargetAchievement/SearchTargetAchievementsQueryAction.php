<?php

namespace Modules\Targets\Http\Controllers\Actions\TargetAchievement;

use Modules\Targets\Entities\TargetAchievement;

class SearchTargetAchievementsQueryAction
{
    function execute()
    {
        // Get all Achievements
        $achievements = TargetAchievement::query()->with('target', 'user');

        //return
        return $achievements;
    }
}
