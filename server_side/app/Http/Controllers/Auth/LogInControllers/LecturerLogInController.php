<?php

namespace App\Http\Controllers\Auth\LogInControllers; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lecturer; 
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Event;

class LecturerLogInController extends Controller
{
    public function showLoginForm()
    {
        return view('LoginFolder/LecturerLogin');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
    
        if (Auth::guard('lecturer')->attempt($credentials)) {
            return redirect()->route('/lecturer/dashboard');
        }
         return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {

        Auth::guard('student')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();   

        return redirect('/lecturer/login');
    }
}
