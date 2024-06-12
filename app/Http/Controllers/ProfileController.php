<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\UserProfile;
use Exception;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function CreateProfile(Request $request)
    {
        try
        {
            $user_id = $request->header('id');
            $request->merge(['user_id'=>$user_id]);
            $data = UserProfile::updateOrCreate(['user_id'=>$user_id], $request->input());

            return ResponseHelper::Out('success', $data, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out('fail', $exception->getMessage(), 401);
        }
    }

    public function ReadProfile(Request $request)
    {
        try
        {
            $user_id = $request->header('id');
            $data = UserProfile::where('user_id', $user_id)->with('user')->first();

            return ResponseHelper::Out('success', $data, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out('fail', $exception->getMessage(), 401);
        }
    }


}
