<?php

namespace App\Http\Controllers\Auth\LogInControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
           // dd($credentials , "Success");
             return redirect()->route('/student/dashboard');
        }
          //  dd("Failed");
             return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }
}
