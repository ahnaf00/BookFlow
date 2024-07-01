<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Helper\ResponseHelper;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    // Admin Dasboard
    public function UsersPage()
    {
        return view('pages.users-page');
    }

    public function RegisterPage()
    {
        return view('pages.register-page');
    }
    public function LoginPage()
    {
        return view('pages.login-page');
    }

    public function VerifyPage()
    {
        return view('pages.verify-page');
    }


    public function UserRegistration(Request $request)
    {
        try
        {
            $UserEmail  = $request->UserEmail;
            $OTP        = rand(100000,999999);
            $details    = ['code'=>$OTP];

            // Check If the user already exists
            $user = User::where('email', $UserEmail)->first();
            if($user)
            {
                $user->update(['otp'=>$OTP]);
            }
            else
            {
                User::create(['email'=>$UserEmail, 'otp'=>$OTP]);
            }

            Mail::to($UserEmail)->send(new OTPMail($details));
            return ResponseHelper::Out('success', 'A 6 difit OTP code has been sent to you email address', 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out('fail', $exception->getMessage(), 401);
        }
    }


    public function UserLogin(Request $request)
    {
        $UserEmail  = $request->UserEmail;
        $user = User::where('email', $UserEmail)->select('id', 'role')->first();

        if($user && $user->role === 'user')
        {
            $token = JWTToken::CreateToken($UserEmail, $user->id, $user->role);
            return response()->json(['status' =>'success', 'role'=>'user'])->cookie('token', $token, 60*24*24);
        }
        else if($user && $user->role == 'admin')
        {
            $token = JWTToken::CreateToken($UserEmail, $user->id, $user->role);
            return response()->json(['status'=>'success', 'role'=>'admin'])->cookie('token', $token, 60*24*24);
        }
        else
        {
            return ResponseHelper::Out('fail', 'Login Failed', 401);
        }

    }

    public function VerifyLogin(Request $request):JsonResponse
    {
        $UserEmail = $request->UserEmail;
        $OTP = $request->OTP;

        $verification = User::where('email', $UserEmail)->where('otp', $OTP)->select('id')->first();

        if($verification)
        {
            User::where('email', $UserEmail)->where('otp', $OTP)->update(['otp'=>0]);

            return ResponseHelper::Out('success', 'User Verification successful', 200);
        }
        else
        {
            return ResponseHelper::Out('fail', '', -1);
        }
    }

    function UserLogout()
    {
        return redirect('/')->cookie('token', '', -1);
    }

    public function UsersList()
    {
        try
        {
            $users = User::where('role', 'user')->with('userProfile')->get();
            return ResponseHelper::Out('sucess', $users, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out('failed', $exception->getMessage(), 401);
        }
    }
}
