<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.master-admin');
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
