<?php

namespace App\Http\Controllers\Auth\LogInControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\ServerLog;

class AdminLogInController extends Controller
{
    public function showLoginForm()
    {
        return view('LoginFolder/AdminLogin');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $username = $credentials['username'];

            $log = new ServerLog();
            $log->username = $username;
            $log->user_level = 'Admin'; 
            $log->request_description = 'Log In'; 
            $log->http_request_type = 'POST'; 
            $log->request_time = now(); 
            $log->save();

        if (Auth::guard('admin')->attempt($credentials)) {
            
            
            $log = new ServerLog();
            $log->username = $username;
            $log->user_level = 'Admin'; 
            $log->request_description = 'Render Admin Dashboard'; 
            $log->http_request_type = 'GET'; 
            $log->request_time = now(); 
            $log->save();
            
            return redirect()->route('/admin/dashboard');

        }
             return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }

    
    public function logout(Request $request)
{
    $username = Auth::guard('admin')->user()->username ?? '';

    $log = new ServerLog();
    $log->username = $username;
    $log->user_level = 'Admin'; 
    $log->request_description = 'Log Out'; 
    $log->http_request_type = 'GET'; 
    $log->request_time = now(); 
    $log->save();

    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();   

    return redirect('/admin/login');
}
}
