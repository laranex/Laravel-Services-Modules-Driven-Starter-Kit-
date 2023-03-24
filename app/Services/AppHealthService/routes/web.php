<?php

Route::get('health', SimpleHealthCheckController::class);
Route::get('/', HealthCheckResultsController::class)->middleware('webBasicAuth');
