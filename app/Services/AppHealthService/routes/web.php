<?php

use App\Services\AppHealthService\Http\Controllers\SimpleHealthCheckController;
use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

Route::get('health', SimpleHealthCheckController::class);
Route::get('/', HealthCheckResultsController::class)->middleware('webBasicAuth');
