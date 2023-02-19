<?php

use App\Enums\PermissionEnum;
use App\Services\Authorization\Http\Controllers\PermissionController;
use App\Services\Authorization\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'authorization'], function () {
    Route::get('/roles', [RoleController::class, 'index'])->permission(PermissionEnum::MANAGE_ROLE->value);
    Route::post('/roles', [RoleController::class, 'create'])->permission(PermissionEnum::MANAGE_ROLE->value);
    Route::get('/roles/{id}', [RoleController::class, 'show'])->permission(PermissionEnum::MANAGE_PERMISSION->value);
    Route::put('/roles/{id}', [RoleController::class, 'update'])->permission(PermissionEnum::MANAGE_ROLE->value);
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->permission(PermissionEnum::MANAGE_ROLE->value);

    Route::get('/permissions', [PermissionController::class, 'index'])->permission(PermissionEnum::MANAGE_PERMISSION->value);
});
