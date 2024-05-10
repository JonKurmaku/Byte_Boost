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
use App\Models\FinalAssessment;
use App\Models\MentorshipApplication;

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

        $log = new ServerLog();
        $log->username = $student->username;
        $log->user_level = 'Student'; 
        $log->request_description = 'Render Course Selection Page'; 
        $log->http_request_type = 'GET'; 
        $log->request_time = now(); 
        $log->save();

        return view('Dashboards\Student\CourseSelection\courseSelection', compact('allCourses', 'chosenCourses'));
        
    }
    
    public function dashboardCourses(){
       
        $student = Auth::guard('student')->user();
        $chosenCourses = $student->courses()->where('student_id', $student->id)->get();
        $mentorshipApplications = MentorshipApplication::where('student_id', $student->id)
        ->where('hasBeenAccepted', true)
        ->get();
        $isMentor = MentorshipApplication::where('student_id', $student->id)
        ->where('hasBeenAccepted', true)->exists();

        $log = new ServerLog();
        $log->username = $student->username;
        $log->user_level = 'Student'; 
        $log->request_description = 'Render Dashboard Courses'; 
        $log->http_request_type = 'GET'; 
        $log->request_time = now(); 
        $log->save();
        
        $mentor = [];

    foreach ($mentorshipApplications as $application) {
    $course = Course::find($application->course_id);
    if ($course) {
        $mentor[] = $course->course_name;
    }
}
        return view('Dashboards\Student\dashboardStd', compact('chosenCourses','mentor','isMentor'));
    }

    public function gradesCourses() {
        $student = Auth::guard('student')->user();
        
        $coursesData = $student->courses()
                              ->selectRaw('courses.*, CONCAT(lecturers.first_name, " ", lecturers.last_name) as lecturer_name')
                              ->leftJoin('lecturers', 'courses.lecturer_id', '=', 'lecturers.id')
                              ->where('student_id', $student->id)
                              ->get();
        
        $finalAssesmentData = FinalAssessment::where('student_id', $student->id)->get();

        $log = new ServerLog();
        $log->username = $student->username;
        $log->user_level = 'Student'; 
        $log->request_description = 'Render Grades'; 
        $log->http_request_type = 'GET'; 
        $log->request_time = now(); 
        $log->save();
        
        return view('Dashboards\Student\Grades\grades', compact('coursesData','finalAssesmentData'));
    }
    

    public function addCourse(Request $request) {
        $courseId = $request->input('course_id');
        $studentId = Auth::guard('student')->user()->id;
        $user = Auth::guard('student')->user();
    
        $student = Student::find($studentId);
        $currentCourseCount = $student->courses()->count();
    
        if ($student->courses->contains($courseId)) {
            return redirect()->back()->with('error', 'You have already chosen this course.');
        }
    
        if ($currentCourseCount < 3) {
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
        } else {
            return redirect()->back()->with('error', 'You have already chosen the maximum number of courses.');
        }
    }
    
    public function removeCourse($courseId){
        $studentId = Auth::guard('student')->user()->id;
        $user = Auth::guard('student')->user();
    
        $student = Student::find($studentId);
        $course = Course::find($courseId);
    
        if ($student->courses->contains($courseId)) {
            $student->courses()->detach($courseId);
            
            $course->num_students_chosen--;
            $course->save();
            
            $log = new ServerLog();
            $log->username = $user->username;
            $log->user_level = 'Student'; 
            $log->request_description = 'Remove Course'; 
            $log->http_request_type = 'DELETE'; 
            $log->request_time = now(); 
            $log->save(); 
            
            return redirect()->back()->with('success', 'Course removed successfully.');
        } else {
            return redirect()->back()->with('error', 'You are not enrolled in this course.');
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

public function renderMentorship(){
    $student = Auth::guard('student')->user();
    $studentId = $student->id;

    $selectedCourses = $student->courses->pluck('id');

    $courses = Course::whereIn('id', $selectedCourses)
                    ->whereNotIn('id', function($query) use ($studentId) {
                        $query->select('course_id')
                              ->from('mentorship_applications')
                              ->where('student_id', $studentId)
                              ->where('hasBeenAccepted', true); 
                    })->get();

    $log = new ServerLog();
    $log->username = $student->username;
    $log->user_level = 'Student'; 
    $log->request_description = 'Render Mentorship Courses'; 
    $log->http_request_type = 'GET'; 
    $log->request_time = now(); 
    $log->save();

    return view('Dashboards\Student\Mentorship\mentorshipProgram', compact('studentId', 'courses'));
}






public function applyMentorship(Request $request)
{
    $student = Auth::guard('student')->user();
    $studentId = $student->id;
    $courseId = $request->input('course_id');
    
    $application = MentorshipApplication::firstOrCreate([
        'student_id' => $studentId,
        'course_id' => $courseId,
    ], [
        'hasBeenAccepted' => false,
    ]);

    if ($application->wasRecentlyCreated) {
        $log = new ServerLog();
        $log->username = $student->username;
        $log->user_level = 'Student'; 
        $log->request_description = 'Apply for Mentorship program'; 
        $log->http_request_type = 'POST'; 
        $log->request_time = now(); 
        $log->save(); 
    }

    return response()->json(['message' => 'Mentorship application submitted successfully']);
}



}
