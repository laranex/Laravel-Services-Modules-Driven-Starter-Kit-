<?php

use App\Services\ApplicationService\Http\Controllers\ApplicationServiceController;
use Illuminate\Support\Facades\Route;

$superAdminRole = \App\Enums\RoleEnum::SUPER_ADMIN->value;
Route::resource('/application_services', ApplicationServiceController::class)
    ->only('index', 'show', 'update')
    ->middleware("role:$superAdminRole");
