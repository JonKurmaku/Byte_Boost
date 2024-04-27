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
use App\Models\MentorshipApplication;
use App\Models\Student;

class LecturerProfileController extends Controller
{
    public function update(Request $request)
    {
        $user=Auth::guard('lecturer')->user();

    $log = new ServerLog();
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


public function renderEvaluation()
{
    $lecturerId = auth()->guard('lecturer')->user()->id;

    $lecturerCourses = Course::where('lecturer_id', $lecturerId)->get();

    return view('\Dashboards\Lecturer\evaluationPage', compact('lecturerCourses'));
}

public function renderMentorshipOverview()
{
    $lecturerId = auth()->guard('lecturer')->user()->id;
    
    $lecturerCourses = Course::where('lecturer_id', $lecturerId)->pluck('course_name', 'id');

    $mentorshipApplications = MentorshipApplication::whereIn('course_id', $lecturerCourses->keys())
        ->where('hasBeenProcessed', 0)
        ->get();

    foreach ($mentorshipApplications as $application) {
        $application->course_name = $lecturerCourses[$application->course_id];
    }

    return view('Dashboards\Lecturer\mentorshipOverview', compact('mentorshipApplications'));
}

public function clearProcessedApplications()
{
    try {
        $applicationsToDelete = MentorshipApplication::where('hasBeenProcessed', true)
            ->where('hasBeenAccepted', false)
            ->get();

        $deletedCount = $applicationsToDelete->count();
        $applicationsToDelete->each->delete();

        return response()->json(['message' => 'Successfully cleared database of ' . $deletedCount . ' records.']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred while clearing database: ' . $e->getMessage()], 500);
    }
}

public function processMentorship(Request $request){
    $studentID = $request->input('student_id');
    $courseID = $request->input('course_id'); 
    $status = $request->input('status');
    $mentorshipApplication = MentorshipApplication::where('student_id', $studentID)
                                      ->where('course_id', $courseID)
                                      ->first();

    if ($mentorshipApplication) {
        $mentorshipApplication->hasBeenAccepted = $status;
        $mentorshipApplication->hasBeenProcessed = 1;
        $mentorshipApplication->save();

        $this->clearProcessedApplications();
        return response()->json(['message' => 'Evaluation submitted successfully']);
    } else {
        return response()->json(['error' => 'Final assessment not found'], 404);
    }
}

public function renderStudentList(){
    $lecturerId = auth()->guard('lecturer')->user()->id;

    $students = Student::whereHas('courses', function ($query) use ($lecturerId) {
        $query->where('lecturer_id', $lecturerId);
    })->with(['courses' => function ($query) use ($lecturerId) {
        $query->where('lecturer_id', $lecturerId);
    }])->get();

    $studentCourseInfo = [];
    foreach ($students as $student) {
        foreach ($student->courses as $course) {
            $studentCourseInfo[] = [
                'student_name' => $student->username,
                'student_id' => $student->id,
                'course_name' => $course->course_name,
                'course_id' => $course->id,
            ];
        }
    }
    return view('Dashboards\Lecturer\studentList', compact('studentCourseInfo'));
}


}
