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
        $user = Auth::guard('student')->user();
    
        $existingFinalAssessment = FinalAssessment::where('student_id', $request->studentId)
                                                   ->where('course_id', $request->courseId)
                                                   ->first();
    
        if ($existingFinalAssessment) {
            $existingFinalAssessment->answer_1 = $request->q1;
            $existingFinalAssessment->answer_2 = $request->q2;
            $existingFinalAssessment->answer_3 = $request->q3;
            $existingFinalAssessment->answer_4 = $request->q4;
            $existingFinalAssessment->answer_5 = $request->q5;
            $existingFinalAssessment->grade = "N/A"; 
            $existingFinalAssessment->save();
    
            return response()->json($existingFinalAssessment, 200);
        } else {
            $finalAssessment = new FinalAssessment();
            $finalAssessment->student_id = $request->studentId;
            $finalAssessment->course_id = $request->courseId;
            $finalAssessment->grade = "N/A"; 
            $finalAssessment->answer_1 = $request->q1;
            $finalAssessment->answer_2 = $request->q2;
            $finalAssessment->answer_3 = $request->q3;
            $finalAssessment->answer_4 = $request->q4;
            $finalAssessment->answer_5 = $request->q5;
            $finalAssessment->save();
    
            $log = new ServerLog();
            $log->username = $user->username;
            $log->user_level = 'Student'; 
            $log->request_description = 'Final Assessment POST'; 
            $log->http_request_type = 'POST'; 
            $log->request_time = now(); 
            $log->save(); 
    
            return response()->json($finalAssessment, 201);
        }
    }
    
public function render($slug){
    $student = Auth::guard('student')->user();
    $course = Course::where('slug', $slug)->firstOrFail();
        
    return view('FinalAssessment.' . $slug . '-final', compact('course', 'student'));
}
    


public function getStudents($courseId) {
    $finalAssessmentStudentIds = FinalAssessment::where('course_id', $courseId)
        ->where('grade', 'N/A')
        ->pluck('student_id')
        ->toArray();

    $students = Student::whereIn('id', $finalAssessmentStudentIds)->get();

    $finalAssessments = FinalAssessment::where('course_id', $courseId)
        ->where('grade', 'N/A')
        ->get();

    $user = Auth::guard('lecturer')->user();
    $log = new ServerLog();
    $log->username = $user->username;
    $log->user_level = 'Lecturer'; 
    $log->request_description = 'Get Students with N/A Grade'; 
    $log->http_request_type = 'GET'; 
    $log->request_time = now(); 
    $log->save();

    $data = [
        'students' => $students,
        'finalAssessments' => $finalAssessments,
    ];
    
    return $data;
}

public function evaluate(Request $request)
{
    $studentID = $request->input('studentID');
    $selectedValue = $request->input('selectedValue');
    $courseID = $request->input('courseID'); 

    $finalAssessment = FinalAssessment::where('student_id', $studentID)
                                      ->where('course_id', $courseID)
                                      ->first();

    if ($finalAssessment) {
        $finalAssessment->grade = $selectedValue;
        $finalAssessment->save();

        return response()->json(['message' => 'Evaluation submitted successfully']);
    } else {
        return response()->json(['error' => 'Final assessment not found'], 404);
    }
}

    }