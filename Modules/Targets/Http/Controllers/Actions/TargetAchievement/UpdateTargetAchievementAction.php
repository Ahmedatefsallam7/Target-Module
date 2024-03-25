<?php

namespace Modules\Targets\Http\Controllers\Actions\TargetAchievement;

use Modules\Targets\Entities\TargetAchievement;
use Modules\Targets\Transformers\TargetAchievementResource;

class UpdateTargetAchievementAction
{
    function execute($data)
    {
        $achievement = TargetAchievement::find($data['id']);

        // Calculate the total achieved amount
        $totalAchievedAmount = $data['achieved_amount'] + $achievement->achieved_amount;

        // Get the target amount
        $targetAmount = $achievement->target->amount;

        // Calculate the achieved amount considering the target limit
        $achievedAmount = ($totalAchievedAmount > $targetAmount) ? $targetAmount : $totalAchievedAmount;

        // Calculate the percentage of achievement
        $percentage = min(100, number_format(($achievedAmount / $targetAmount) * 100, 2));


        // Prepare data for update
        $updateData = [
            'achieved_amount' => $achievedAmount,
            'percentage' => $percentage,
        ];

        // Update the achievement with the new data
        $achievement->update($updateData);

        // return
        return new TargetAchievementResource($achievement);
    }
}
