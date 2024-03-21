<?php

use Illuminate\Support\Facades\Route;
use Modules\Targets\Http\Controllers\V1\TargetsController;
use Modules\Targets\Http\Controllers\V1\TargetAchievementsController;

Route::prefix('targets/v1')->group(function () {
    Route::resource('targets', TargetsController::class);
});

Route::prefix('achievements/v1')->group(function () {
    Route::resource('target-achievements', TargetAchievementsController::class);
});
