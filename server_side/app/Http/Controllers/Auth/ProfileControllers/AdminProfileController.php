<?php

namespace App\Http\Controllers\Auth\ProfileControllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Lecturer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminProfileController extends Controller
{
    public function userActivity(Request $request){
        $user=Auth::guard('admin')->user();

        $admins = DB::table('admins')->select('id', 'username', 'created_at', 'updated_at')->get();
        $lecturers = DB::table('lecturers')->select('id', 'username', 'created_at', 'updated_at')->get();
        $students = DB::table('students')->select('id', 'username', 'created_at', 'updated_at')->get();
    
        return view('Dashboards/Admin/AdminLogs/userActivityLog', compact('admins', 'lecturers', 'students'));

    }

    public function serverLog(Request $request){
        $user=Auth::guard('admin')->user();

        $serverLogTable = DB::table('server_logs')->select('username', 'user_level', 'request_description', 'http_request_type', 'request_time')->get();
    
        return view('\Dashboards\Admin\AdminLogs\serverLog', ['serverLogTable' => $serverLogTable]);
    }
}
