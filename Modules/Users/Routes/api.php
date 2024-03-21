<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\V1\UsersController;

Route::prefix('users/v1')->group(function () {
    Route::apiResource('users', UsersController::class);
});
