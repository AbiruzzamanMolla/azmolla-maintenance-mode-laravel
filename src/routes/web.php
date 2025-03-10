<?php

use Azmolla\MaintenanceMode\Controllers\MaintenanceModeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/maintenance')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [MaintenanceModeController::class, 'index'])->name('admin.maintenance.index');
    Route::post('/update', [MaintenanceModeController::class, 'update'])->name('admin.maintenance.update');
});
