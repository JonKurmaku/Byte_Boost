<?php

namespace App\Http\Controllers\SignUpControllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Http\Controllers\Controller;
use App\Models\ServerLog;
class LecturerController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:lecturers',
            'password' => 'required|string|min:6|confirmed',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'experience' => 'nullable|integer',
            
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        Lecturer::create($validatedData);

        $log = new ServerLog();
    $log->username = $validatedData['username'];
    $log->user_level = 'Lecturer'; 
    $log->request_description = 'Create Profile'; 
    $log->http_request_type = 'POST'; 
    $log->request_time = now(); 
    $log->save(); 

        return redirect('/lecturer/login')->with('success', 'Student created successfully');
    }
}
