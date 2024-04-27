<?php

namespace App\Http\Controllers\Auth\ProfileControllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ServerLog;

class AdminProfileController extends Controller
{
    public function userActivity(Request $request){
        $user=Auth::guard('admin')->user();

        $admins = DB::table('admins')->select('id', 'username', 'created_at', 'updated_at')->get();
        $lecturers = DB::table('lecturers')->select('id', 'username', 'created_at', 'updated_at')->get();
        $students = DB::table('students')->select('id', 'username', 'created_at', 'updated_at')->get();
        
        $log = new ServerLog();
        $log->username = $user->username;
        $log->user_level = 'Admin'; 
        $log->request_description = 'Render User Activity Log'; 
        $log->http_request_type = 'GET'; 
        $log->request_time = now(); 
        $log->save();

        return view('Dashboards/Admin/AdminLogs/userActivityLog', compact('admins', 'lecturers', 'students'));

    }

    public function serverLog(Request $request){
        $user=Auth::guard('admin')->user();

        $serverLogTable = DB::table('server_logs')->select('username', 'user_level', 'request_description', 'http_request_type', 'request_time')->get();
    
        $log = new ServerLog();
        $log->username = $user->username;
        $log->user_level = 'Admin'; 
        $log->request_description = 'Render Server Log'; 
        $log->http_request_type = 'GET'; 
        $log->request_time = now(); 
        $log->save();

        return view('\Dashboards\Admin\AdminLogs\serverLog', ['serverLogTable' => $serverLogTable]);
    }

    public function dashboardModels(){
        $students = Student::all();
        $lecturers = Lecturer::all();
        $courses = Course::all();
        $user=Auth::guard('admin')->user();

        $log = new ServerLog();
        $log->username = $user->username;
        $log->user_level = 'Admin'; 
        $log->request_description = 'Render Dashboard List'; 
        $log->http_request_type = 'GET'; 
        $log->request_time = now(); 
        $log->save();

        return view('Dashboards/Admin/dashboardAdmin', compact('courses', 'lecturers', 'students'));
    }

    public function deleteStudent($student_id)
    {
        try {
            $student = Student::findOrFail($student_id);
            $student->delete();
            
            $user=Auth::guard('admin')->user();

            $log = new ServerLog();
            $log->username = $user->username;
            $log->user_level = 'Admin'; 
            $log->request_description = 'Delete Student'; 
            $log->http_request_type = 'DELETE'; 
            $log->request_time = now(); 
            $log->save();

            return redirect()->back()->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete student.');
        }
    }

    public function deleteLecturer($lecturer_id)
    {
        try {
            $lecturer = Lecturer::findOrFail($lecturer_id);
            $lecturer->delete();
            
            $user=Auth::guard('admin')->user();

            $log = new ServerLog();
            $log->username = $user->username;
            $log->user_level = 'Admin'; 
            $log->request_description = 'Delete Lecturer'; 
            $log->http_request_type = 'DELETE'; 
            $log->request_time = now(); 
            $log->save();

            return redirect()->back()->with('success', 'Lecturer deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete lecturer.');
        }
    }


    public function deleteCourse($course_id)
    {
        try {
            $course = Course::findOrFail($course_id);
            $course->delete();
            
            $user=Auth::guard('admin')->user();

            $log = new ServerLog();
            $log->username = $user->username;
            $log->user_level = 'Admin'; 
            $log->request_description = 'Delete Course'; 
            $log->http_request_type = 'DELETE'; 
            $log->request_time = now(); 
            $log->save();

            return redirect()->back()->with('success', 'Course deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Course to delete lecturer.');
        }
    }



    public function updateStudent(Request $request)
    {
        $user = Auth::guard('admin')->user();
        
        $student = Student::find($request->studentID);
        
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }
    
        $student->first_name = $request->studentFirstname;
        $student->last_name = $request->studentLastname;
        $student->email = $request->studentEmail;
        $student->program = $request->studentProgram;        
    
        $student->save();
    
        $log = new ServerLog();
        $log->username = $user->username;
        $log->user_level = 'Admin'; 
        $log->request_description = 'Update Student Credentials'; 
        $log->http_request_type = 'PUT'; 
        $log->request_time = now(); 
        $log->save(); 
    
        return response()->json(['message' => 'Profile updated successfully'], 200);
    }


    public function updateLecturer(Request $request)
    {
        $user = Auth::guard('admin')->user();
        
        $lecturer = Lecturer::find($request->lecturerID);
        
        if (!$lecturer) {
            return response()->json(['error' => 'Lecturer not found'], 404);
        }
    
        $lecturer->first_name = $request->lecturerFirstname;
        $lecturer->last_name = $request->lecturerLastname;
        $lecturer->email = $request->lecturerEmail;
        $lecturer->department = $request->lecturerDepartment;        
        $lecturer->specialization = $request->lecturerSpecialization;
        $lecturer->save();
    
        $log = new ServerLog();
        $log->username = $user->username;
        $log->user_level = 'Admin'; 
        $log->request_description = 'Update Lectuer Credentials'; 
        $log->http_request_type = 'PUT'; 
        $log->request_time = now(); 
        $log->save(); 
    
        return response()->json(['message' => 'Profile updated successfully'], 200);
    }



    public function updateCourse(Request $request)
    {
        $user = Auth::guard('admin')->user();
        
        $courses = Course::find($request->courseID);
        
        if (!$courses) {
            return response()->json(['error' => 'Courses not found'], 404);
        }
    
        $courses->course_name = $request->courseName;
        $courses->max_students = $request->courseMaxnumber;
         
    
        $courses->save();
    
        $log = new ServerLog();
        $log->username = $user->username;
        $log->user_level = 'Admin'; 
        $log->request_description = 'Update Courses Credentials'; 
        $log->http_request_type = 'PUT'; 
        $log->request_time = now(); 
        $log->save(); 
    
        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
    

}


