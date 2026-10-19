<?php

use App\Http\Controllers\Api\LicenseApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('throttle:60,1')->group(function () {
    Route::post('license/activate', [LicenseApiController::class, 'activate']);
    Route::post('license/validate', [LicenseApiController::class, 'validateKey']);
    Route::post('license/deactivate', [LicenseApiController::class, 'deactivate']);
});
