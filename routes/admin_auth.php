<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('admin/login', [AuthenticatedSessionController::class, 'create']);
    Route::post('admin/login', [AuthenticatedSessionController::class, 'store'])
                ->name('admin.login');
});

Route::middleware('admin')->group(function () {
    Route::post('admin/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('admin.logout');
});
