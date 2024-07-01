<?php

use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AccessMiddleware;
use App\Http\Middleware\TokenAuthenticateMiddleware;
use App\Models\Category;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'HomePage'])->name('HomePage');

Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::get('/AdminLogOut', [AdminController::class, 'AdminLogOut'])->name('AdminLogOut');
Route::get('/summery', [AdminController::class, 'Summery'])->name('summery')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::get('/aboutus', [HomeController::class, 'AboutUs'])->name('AboutUs');

// User Auth
Route::get('/UserRegistration/{UserEmail}', [UserController::class, 'UserRegistration']);
Route::get('/UserLogin/{UserEmail}', [UserController::class, 'UserLogin']);
Route::get('/VerifyLogin/{UserEmail}/{OTP}', [UserController::class, 'VerifyLogin']);
Route::get('/UserLogout', [UserController::class, 'UserLogout'])->name('logout');


Route::get('/user-page', [UserController::class, 'UsersPage'])->name('UsersPage');
Route::get('/users-list', [UserController::class, 'UsersList'])->name('UsersList')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);


// User Login and Verify View
Route::get('/register', [UserController::class, 'RegisterPage'])->name('RegisterView');
Route::get('/login', [UserController::class, 'LoginPage'])->name('loginView');
Route::get('/verify', [UserController::class, 'VerifyPage'])->name('verifyView');


// User
Route::get('/ReadProfile', [ProfileController::class, 'ReadProfile'])->middleware([TokenAuthenticateMiddleware::class]);
Route::post('/CreateProfile', [ProfileController::class, 'CreateProfile'])->middleware([TokenAuthenticateMiddleware::class]);
Route::get('/user-profile', [ProfileController::class, 'ProfilePage'])->name('ProfilePage');

// Category
Route::get('/category-page', [CategoryController::class, 'CategoryPage'])->name('CategoryPage')->middleware([TokenAuthenticateMiddleware::class]);
// category api
Route::get('/category-list', [CategoryController::class, 'CategoryList'])->name('CategoryList');
Route::post('/category-create', [CategoryController::class, 'CreateCategory'])->name('CreteCategory')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::post('/category-update', [CategoryController::class, 'UpdateCategory'])->name('UpdateCategory')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::post('/category-by-id', [CategoryController::class, 'CategoryById'])->name('CategoryById')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::post('/delete-category', [CategoryController::class, 'DeleteCategory'])->name('DeleteCategory')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);

// Subcategory
Route::get('/subcategory-page', [SubCategoryController::class, 'SubCategoryPage'])->name('SubCategoryPage')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::get('/subcategory-list', [SubCategoryController::class, 'SubCategoryList'])->name('SubCategoryList')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::post('/subcategory-by-id', [SubCategoryController::class, 'SubCategoryById'])->name('SubCategoryById')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::post('/subcategory-create', [SubCategoryController::class, 'CreateSubCategory'])->name('CreteSubCategory')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::post('/subcategory-update', [SubCategoryController::class, 'UpdateSubCategory'])->name('UpdateSubCategory')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::post('/subcategory-delete', [SubCategoryController::class, 'DeleteSubCategory'])->name('DeleteSubCategory')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);

// Book
Route::get('/book-page', [BookController::class, 'BookPage'])->name('BooksPage')->middleware([TokenAuthenticateMiddleware::class]);
Route::get('/book-list', [BookController::class, 'BookList'])->name('BookList');
Route::post('/book-create', [BookController::class, 'CreateBook'])->name('CreateBook')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::post('/book-update', [BookController::class, 'UpdateBook'])->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::post('/book-by-id', [BookController::class, 'BookById'])->name('BookById');
Route::post('/book-delete', [BookController::class, 'DeleteBook'])->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::get('/book-details/{id}', [BookController::class, 'BookDetails'])->name('BookDetails');

Route::post('/bookquantity-update', [BookController::class, 'QuantityUpdate'])->name('QuantityUpdate');


// Landings
Route::get('/lending-page', [LandingController::class, 'LendingPage'])->name('LendingPage')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::get('/lending-list', [LandingController::class, 'ListLandings'])->name('LendingList')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::post('/landing-create', [LandingController::class, 'CreateLanding'])->name('CreateLanding')->middleware([TokenAuthenticateMiddleware::class]);
Route::post('/getlanding-by-id', [LandingController::class, 'GetLandingById'])->name('GetLandingById')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::post('/landings-update', [LandingController::class, 'UpdateLanding'])->name('UpdateLanding')->middleware([TokenAuthenticateMiddleware::class, AccessMiddleware::class]);
Route::post('/landings-delete', [LandingController::class, 'DeleteLanding'])->name('DeleteLanding');
Route::get('/booking-list', [LandingController::class, 'BookingList'])->name('BookingList')->middleware([TokenAuthenticateMiddleware::class]);

Route::get('/booking-page', [LandingController::class, 'BookingPage'])->name('BookingPage');

// Search
Route::post('/search/{searchWord}', [BookController::class, 'Search'])->name('search');
