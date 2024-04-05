<?php

namespace App\Http\Controllers\Auth\LogInControllers; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lecturer; 
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Event;
use App\Models\ServerLog;

class LecturerLogInController extends Controller
{
    public function showLoginForm()
    {
        return view('LoginFolder/LecturerLogin');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
    
        $username = $credentials['username'];

            $log = new ServerLog();
            $log->username = $username;
            $log->user_level = 'Lecturer'; 
            $log->request_description = 'Log In'; 
            $log->http_request_type = 'POST'; 
            $log->request_time = now(); 
            $log->save();

        if (Auth::guard('lecturer')->attempt($credentials)) {
            
            $log = new ServerLog();
            $log->username = $username;
            $log->user_level = 'Lecturer'; 
            $log->request_description = 'Render Lecturer Dashboard'; 
            $log->http_request_type = 'GET'; 
            $log->request_time = now(); 
            $log->save();

            return redirect()->route('/lecturer/dashboard');
        }
         return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        $username = Auth::guard('lecturer')->user()->username ?? '';
    
        $log = new ServerLog();
        $log->username = $username;
        $log->user_level = 'Lecturer'; 
        $log->request_description = 'Log Out'; 
        $log->http_request_type = 'GET'; 
        $log->request_time = now(); 
        $log->save();
    
        Auth::guard('lecturer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();   
    
        return redirect('/lecturer/login');
    }
}
