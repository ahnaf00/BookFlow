<?php

use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenAuthenticateMiddleware;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard')->middleware(TokenAuthenticateMiddleware::class);
Route::get('/AdminLogOut', [AdminController::class, 'AdminLogOut'])->name('AdminLogOut');

// User Auth
Route::get('/UserRegistration/{UserEmail}', [UserController::class, 'UserRegistration']);
Route::get('/UserLogin/{UserEmail}', [UserController::class, 'UserLogin']);
Route::get('/VerifyLogin/{UserEmail}/{OTP}', [UserController::class, 'VerifyLogin']);
Route::get('/UserLogout', [UserController::class, 'UserLogout'])->name('logout');


// User Login and Verify View
Route::get('/register', [UserController::class, 'RegisterPage'])->name('RegisterView');
Route::get('/login', [UserController::class, 'LoginPage'])->name('loginView');
Route::get('/verify', [UserController::class, 'VerifyPage'])->name('verifyView');


// User Login and Verify
Route::get('/CreateProfile', [ProfileController::class, 'CreateProfile'])->middleware([TokenAuthenticateMiddleware::class]);
Route::get('/ReadProfile', [ProfileController::class, 'ReadProfile'])->middleware([TokenAuthenticateMiddleware::class]);


Route::get('/', [HomeController::class, 'HomePage'])->name('HomePage');
