<?php

namespace App\Http\Controllers\Auth\LectureController;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function show($slug){
    $student=Auth::guard('student')->user();
    $course = Course::where('slug', $slug)->firstOrFail();

        return view('lectures.' . $slug, compact('course','student'));
    }
}
