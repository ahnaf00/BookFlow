<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::prefix('admin')->as('admin.')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'AdminDashboard'])->name('dashboard');
    });

    // User Management
    Route::resource('users', 'App\Http\Controllers\Admin\UserController');
});

// User Routes
Route::middleware('users')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/admin_auth.php';
require __DIR__ . '/auth.php';
