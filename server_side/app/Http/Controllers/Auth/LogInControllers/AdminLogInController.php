<?php

namespace App\Http\Controllers\Auth\LogInControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminLogInController extends Controller
{
    public function showLoginForm()
    {
        return view('LoginFolder/AdminLogin');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
             return redirect()->route('/admin/dashboard');
        }
             return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }

    
    public function logout(Request $request)
    {

        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();   

        return redirect('/admin/login');
    }
}
