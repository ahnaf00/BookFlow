<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Book;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.master-admin');
    }

    public function Summery()
    {
        try
        {
            $bookCount          = Book::count();
            $categoriesCount    = Category::count();
            $subCategoryCount   = SubCategory::count();
            $usersCount         = User::count();

            $data = [
                "book"          =>  $bookCount,
                "category"      =>  $categoriesCount,
                "subcategory"   =>  $subCategoryCount,
                "users"         =>  $usersCount
            ];

            return ResponseHelper::Out('success', $data, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out('failed', $exception->getMessage(), 401);
        }
    }


    public function AdminLoginView()
    {
        return view('admin.admin-login-view');
    }

    public function AdminLogOut()
    {
        return redirect('/')->cookie('token', '', -1);
    }
}
