<?php

namespace App\Http\Controllers\Auth\ProfileControllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\ServerLog;

class StudentProfileController extends Controller
{
    public function update(Request $request)
    {
        $user=Auth::guard('student')->user();

    /*   $request=json_decode($request);
        $request->validate([
            'n_username' => 'required|string|max:255|unique:students',
            'n_password' => 'required|string|min:6', 
        ]);
    */  
    $log = new ServerLog();
    $log->username = $user->username;
    $log->user_level = 'Student'; 
    $log->request_description = 'Update Profile Credentials'; 
    $log->http_request_type = 'PUT'; 
    $log->request_time = now(); 
    $log->save(); 
        
        $user->username = $request->input('n_username');
        $user->password = Hash::make($request->input('n_password')); 

        $user->save();

        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
}
