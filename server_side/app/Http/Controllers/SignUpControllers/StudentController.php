<?php

namespace App\Http\Controllers\SignUpControllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Models\ServerLog;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:students',
            'email' => 'required|email|max:255|unique:students',
            'password' => 'required|string|min:6|confirmed',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'program' => 'required|string|max:255',
            'gender' => 'nullable|string',
            'dob' => 'required|date',
            'country' => 'nullable|string',
            'interests' => 'nullable|string'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        Student::create($validatedData);

        $log = new ServerLog();
        $log->username = $validatedData['username'];
        $log->user_level = 'Student'; 
        $log->request_description = 'Create Profile'; 
        $log->http_request_type = 'POST'; 
        $log->request_time = now(); 
        $log->save(); 

        return redirect('/student/login')->with('success', 'Student created successfully');
    }
}
