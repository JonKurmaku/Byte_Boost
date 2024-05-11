<?php

namespace App\Http\Controllers\Auth\LectureController;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ServerLog;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\View;

class CourseController extends Controller
{
    public function show($slug){
        $student = Auth::guard('student')->user();
        $course = Course::where('slug', $slug)->firstOrFail();
        
        $lectureView = 'lectures.' . $slug;
        if (!View::exists($lectureView)) {
            return view('lectures.404'); 
        }

        $log = new ServerLog();
        $log->username = $student->username;
        $log->user_level = 'Student'; 
        $log->request_description = 'Courses Render'; 
        $log->http_request_type = 'GET'; 
        $log->request_time = now(); 
        $log->save(); 

        return view($lectureView, compact('course', 'student'));
    }
}



