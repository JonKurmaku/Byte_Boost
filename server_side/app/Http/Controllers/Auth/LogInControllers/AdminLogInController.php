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
           // dd($credentials , "Success");
             return redirect()->route('/admin/dashboard');
        }
          //  dd("Failed");
             return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }
}
