<?php

use App\Http\Controllers\Api\V1\MovieController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::post(
        'movies/{id}/restore',
        [MovieController::class, 'restore']
    );

    Route::apiResource('movies', MovieController::class);

});