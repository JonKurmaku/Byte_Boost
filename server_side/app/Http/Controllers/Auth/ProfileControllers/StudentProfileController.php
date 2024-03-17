<?php

namespace App\Http\Controllers\Auth\ProfileControllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        
        $user->username = $request->input('n_username');
        $user->password = Hash::make($request->input('n_password')); 

        $user->save();

        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
}
