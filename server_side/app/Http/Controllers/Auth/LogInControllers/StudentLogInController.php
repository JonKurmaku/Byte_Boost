<?php

namespace App\Http\Controllers\Auth\LogInControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class StudentLogInController extends Controller
{
    public function showLoginForm()
    {
        return view('LoginFolder/StudentLogin');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('student')->attempt($credentials)) {
             return redirect()->route('/student/dashboard');
        }
             return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }
    public function logout(Request $request)
{
    Auth::guard('student')->logout(); 
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/student/login');
}

}



