<?php

namespace App\Http\Controllers\Auth\LectureController;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        return view('lectures.' . $slug, compact('course'));
    }
}
