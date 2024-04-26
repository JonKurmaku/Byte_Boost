<?php

namespace App\Http\Controllers\Auth\LectureController;

use App\Http\Controllers\Controller;
use App\Models\FinalAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\ServerLog;
use App\Models\Student; 

class FinalAssessmentController extends Controller
{
   
public function store(Request $request)
{
    $user= Auth::guard('student')->user();

    $finalAssessment = new FinalAssessment();
    $finalAssessment->student_id = $request->studentId;
    $finalAssessment->course_id = $request->courseId;
    $finalAssessment->grade = $request->grade; 
    $finalAssessment->answer_1 =$request->q1;
    $finalAssessment->answer_2 =$request->q2;
    $finalAssessment->answer_3 =$request->q3;
    $finalAssessment->answer_4 =$request->q4;
    $finalAssessment->answer_5 =$request->q5;


    $finalAssessment->save();

    $log = new ServerLog();
    $log->username = $user->username;
    $log->user_level = 'Student'; 
    $log->request_description = 'Final Assesment POST'; 
    $log->http_request_type = 'POST'; 
    $log->request_time = now(); 
    $log->save(); 

    return response()->json($finalAssessment, 201);
}

public function render($slug){
    $student = Auth::guard('student')->user();
    $course = Course::where('slug', $slug)->firstOrFail();
        
    return view('FinalAssessment.' . $slug . '-final', compact('course', 'student'));
}
    


public function getStudents($courseId) {
    $finalAssessmentStudentIds = FinalAssessment::where('course_id', $courseId)->pluck('student_id')->toArray();
        $students = Student::whereIn('id', $finalAssessmentStudentIds)->get();
        $finalAssessments = FinalAssessment::where('course_id', $courseId)->get();

    $user = Auth::guard('lecturer')->user();
    $log = new ServerLog();
    $log->username = $user->username;
    $log->user_level = 'Lecturer'; 
    $log->request_description = 'Final Assessment GET'; 
    $log->http_request_type = 'GET'; 
    $log->request_time = now(); 
    $log->save();

    $data = [
        'students' => $students,
        'finalAssessments' => $finalAssessments,
    ];
    
    return $data;
}

  
    }