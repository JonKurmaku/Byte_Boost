<?php

namespace App\Http\Controllers\Auth\ProfileControllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\ServerLog;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Feedbacks;

class StudentProfileController extends Controller
{
    public function update(Request $request)
    {
        $user=Auth::guard('student')->user();

    
    $log = new ServerLog();
    $log->username = $user->username;
    $log->user_level = 'Student'; 
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
        $allCourses = Course::all();

        $student = Auth::guard('student')->user();
        $chosenCourses = $student->courses()->where('student_id', $student->id)->get();
    
        $allCourses = Course::whereNotIn('id', $chosenCourses->pluck('id'))->get();
        return view('Dashboards\Student\CourseSelection\courseSelection', compact('allCourses', 'chosenCourses'));
        
    }
    
    public function dashboardCourses(){
       
        $student = Auth::guard('student')->user();
        $chosenCourses = $student->courses()->where('student_id', $student->id)->get();
       
        return view('Dashboards\Student\dashboardStd', compact('chosenCourses'));
    }

    public function gradesCourses() {
        $student = Auth::guard('student')->user();
        
        $coursesData = $student->courses()
                              ->selectRaw('courses.*, CONCAT(lecturers.first_name, " ", lecturers.last_name) as lecturer_name')
                              ->leftJoin('lecturers', 'courses.lecturer_id', '=', 'lecturers.id')
                              ->where('student_id', $student->id)
                              ->get();
        
        return view('Dashboards\Student\Grades\grades', compact('coursesData'));
    }
    

    public function addCourse(Request $request) {
        $courseId = $request->input('course_id');
        $studentId=Auth::guard('student')->user()->id;
        $user=Auth::guard('student')->user();

        $student = Student::find($studentId);
        if ($student->courses->contains($courseId)) {
            return redirect()->back()->with('error', 'You have already chosen this course.');
        }
    
        $course = Course::findOrFail($courseId);
        if ($course->num_students_chosen < $course->max_students) {
            $course->students()->attach($studentId);
            $course->num_students_chosen++;
            $course->save();
            
            $log = new ServerLog();
            $log->username = $user->username;
            $log->user_level = 'Student'; 
            $log->request_description = 'Add Course'; 
            $log->http_request_type = 'POST'; 
            $log->request_time = now(); 
            $log->save(); 
            
            return redirect()->back()->with('success', 'Course added successfully.');
        } else {
            return redirect()->back()->with('error', 'This course is already full.');
        }
    }


    public function fetchLecturers()
    {
        $lecturers = Lecturer::all('id', 'first_name', 'last_name'); 
        return response()->json($lecturers);
    }

    public function fetchLecturerCourses($lecturerId)
    {
        $lecturer = Lecturer::findOrFail($lecturerId);
        $courses = $lecturer->courses()->get(['id', 'course_name']); 
        return response()->json($courses);
    }



public function giveFeedback(Request $request)
{
    $user = Auth::guard('student')->user();
    $studentId = $user->id;
    $courseId = $request->input('course_id');
    $comment = $request->input('comment');
    $rating = $request->input('rating');

    $feedback = new Feedbacks();
    $feedback->student_id = $studentId;
    $feedback->course_id = $courseId;
    $feedback->comment = $comment;
    $feedback->rating = $rating;
    $feedback->save();

    $log = new ServerLog();
    $log->username = $user->username;
    $log->user_level = 'Student'; 
    $log->request_description = 'Send Course Feedback'; 
    $log->http_request_type = 'POST'; 
    $log->request_time = now(); 
    $log->save(); 
}

}
