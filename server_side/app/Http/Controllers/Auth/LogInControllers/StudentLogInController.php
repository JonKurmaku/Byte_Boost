<?php

namespace App\Http\Controllers\Auth\LogInControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\Models\ServerLog;

class StudentLogInController extends Controller
{
    public function showLoginForm()
    {
        return view('LoginFolder/StudentLogin');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $username = $credentials['username'];

            $log = new ServerLog();
            $log->username = $username;
            $log->user_level = 'Student'; 
            $log->request_description = 'Log In'; 
            $log->http_request_type = 'POST'; 
            $log->request_time = now(); 
            $log->save(); 

        if (Auth::guard('student')->attempt($credentials)) {
            
            $log = new ServerLog();
            $log->username = $username;
            $log->user_level = 'Student'; 
            $log->request_description = 'Render Student Dashboard'; 
            $log->http_request_type = 'GET'; 
            $log->request_time = now(); 
            $log->save(); 
            
            return redirect()->route('/student/dashboard');

        }
             return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Cookie::queue(Cookie::forget('your_session_cookie_name'));
        Auth::guard('student')->logout();
    
        $username = Auth::guard('student')->user()->username ?? '';
            $log = new ServerLog();
            $log->username = $username;
            $log->user_level = 'Student'; 
            $log->request_description = 'Log Out'; 
            $log->http_request_type = 'GET'; 
            $log->request_time = now(); 
            $log->save(); 

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
        return redirect('/student/login');
    }

}



