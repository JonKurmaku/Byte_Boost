<?php

namespace App\Http\Controllers\Auth\ProfileControllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\ServerLog;
use App\Models\Course;
use App\Models\Feedbacks;

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
    */  $log = new ServerLog();
    $log->username = $user->username;
    $log->user_level = 'Lecturer'; 
    $log->request_description = 'Update Profile Credentials'; 
    $log->http_request_type = 'PUT'; 
    $log->request_time = now(); 
    $log->save(); 
        
        $user->username = $request->input('n_username');
        $user->password = Hash::make($request->input('n_password')); 

        $user->save();

        return response()->json(['message' => 'Profile updated successfully'], 200);
    }



public function showCourses() {
    
    $lecturerId = auth()->guard('lecturer')->user()->id;

    $lecturerCourses = Course::where('lecturer_id', $lecturerId)->get();

    return view('\Dashboards\Lecturer\coursePage', compact('lecturerCourses'));
}


public function addCourses(Request $request){
    $user=Auth::guard('lecturer')->user();
    
    $course = new Course();
    $course->lecturer_id = auth()->guard('lecturer')->user()->id; 
    $course->course_id = $request['course_id'];
    $course->course_name = $request['course_name'];
    $course->num_students_chosen = 0;
    $course->max_students = $request['max_students'];

    $course->save();

    $log = new ServerLog();
    $log->username = $user->username;
    $log->user_level = 'Lecturer'; 
    $log->request_description = 'Add Course'; 
    $log->http_request_type = 'POST'; 
    $log->request_time = now(); 
    $log->save(); 

    return response()->json(['message' => 'Course added successfully'], 201);
}


public function deleteCourse($id)
{
    $user=Auth::guard('lecturer')->user();

    $course = Course::where('course_id', $id)->firstOrFail();
    $course->delete();


    $log = new ServerLog();
    $log->username = $user->username;
    $log->user_level = 'Lecturer'; 
    $log->request_description = 'Delete Course'; 
    $log->http_request_type = 'DELETE'; 
    $log->request_time = now(); 
    $log->save(); 

    return response()->json(['message' => 'Course deleted successfully'], 200);
}

public function showFeedback()
{
    $lecturer=Auth::guard('lecturer')->user();
   
    $feedback = Feedbacks::whereHas('course', function ($query) use ($lecturer) {
        $query->where('lecturer_id', $lecturer->id);
    })->get();

    return view('\Dashboards\Lecturer\feedbackPage', compact('feedback'));
}

}
