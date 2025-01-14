<?php

namespace Modules\Targets\Http\Controllers\Actions\TargetAchievement;

use Modules\Targets\Entities\Target;
use Modules\Targets\Entities\TargetAchievement;
use Modules\Targets\Transformers\TargetAchievementResource;

class UpdateTargetAchievementAction {
    public function execute( $data ) {

        $achievement = TargetAchievement::find( $data[ 'id' ] );

        // Get the target amount for the associated target
        $targetAmount = Target::where( 'id', $achievement->achievable_id )->value( 'amount' );

        // Calculate the total achieved amount
        $totalAchievedAmount = $data[ 'achieved_amount' ] + $achievement->achieved_amount;

        // Calculate the achieved amount considering the target limit
        $achievedAmount = min( $totalAchievedAmount, $targetAmount );

        // Calculate the percentage of achievement
        $percentage = min( 100, number_format( ( $achievedAmount / $targetAmount ) * 100, 2 ) );

        // Prepare data for updating the achievement
        $updateData = [
            'achieved_amount' => $achievedAmount,
            'percentage' => $percentage,
        ];

        // Update the achievement with the new data
        $achievement->update( $updateData );

        // Return
        return new TargetAchievementResource( $achievement );
    }
}
