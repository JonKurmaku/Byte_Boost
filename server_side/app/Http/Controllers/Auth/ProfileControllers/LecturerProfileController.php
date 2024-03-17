<?php

namespace App\Http\Controllers\Auth\ProfileControllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LecturerProfileController extends Controller
{
    public function update(Request $request)
    {
        $user=Auth::guard('lecturer')->user();

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
