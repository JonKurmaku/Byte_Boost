<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SignUpControllers\LecturerController;
use App\Http\Controllers\SignUpControllers\StudentController;

use App\Http\Controllers\Auth\LogInControllers\LecturerLogInController;
use App\Http\Controllers\Auth\LogInControllers\StudentLogInController;
use App\Http\Controllers\Auth\LogInControllers\AdminLogInController;

use App\Http\Controllers\Auth\ProfileControllers\StudentProfileController;
use App\Http\Controllers\Auth\ProfileControllers\LecturerProfileController;
use App\Http\Controllers\Auth\ProfileControllers\AdminProfileController;
use App\Http\Controllers\Auth\LectureController\CourseController;
use App\Http\Controllers\Auth\LectureController\FinalAssessmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// routes/web.php

//Test Database Connection

Route::get('/test-database-connection', function () {
    try {
        DB::connection()->getPdo();
        echo "Connected successfully to the database!";
    } catch (\Exception $e) {
        die("Could not connect to the database. Error: " . $e->getMessage());
    }
});

Route::get('/', function () {
    return view('MainPage/MainPage');
});

Route::get('/StudentLogin', function () {
    return view('LoginFolder/StudentLogin');
});

Route::get('/LecturerLogin', function () {
    return view('LoginFolder/LecturerLogin');
});

Route::get('/AdminLogin', function () {
    return view('LoginFolder/AdminLogin');
});

Route::get('/LecturerSignUp', function () {
    return view('SignUpFolder/LecturerSignIn');
});

Route::get('/StudentSignUp', function () {
    return view('SignUpFolder/StudentSignIn');
});

Route::get('/lecturer/dashboard',[LecturerProfileController::class,'showDashboardCourses'])
->name('/lecturer/dashboard');

Route::get('/student/dashboard', [StudentProfileController::class, 'dashboardCourses']) 
->name('/student/dashboard');;

Route::get('/admin/dashboard', [AdminProfileController::class,'dashboardModels'])
->name('/admin/dashboard');

Route::get('/student/dashboard/courseSelection', [StudentProfileController::class, 'showCourses'])
    ->name('student.dashboard.courseSelection');

Route::get('/student/dashboard/feedback', function () {
    return view('/Dashboards/Student/FeedbackPage/feedbackPage'); 
})->name('/student/dashboard/feedback');

Route::get('/student/dashboard/grades', [StudentProfileController::class, 'gradesCourses']) 
->name('/student/dashboard/grades');

Route::get('/admin/dashboard/activity', function () {
    return view('/Dashboards/Admin/AdminLogs/userActivityLog'); 
})->name('/admin/dashboard/activity');

Route::get('/admin/dashboard/server-logs', function () {
    return view('/Dashboards/Admin/AdminLogs/serverLog'); 
})->name('/admin/dashboard/server-logs');

Route::post('lecturers', [LecturerController::class, 'store'])->name('lecturer.store');
Route::post('students', [StudentController::class, 'store'])->name('student.store');

Route::get('lecturer/login', [LecturerLogInController::class, 'showLoginForm'])->name('lecturer.login');
Route::post('lecturer/login', [LecturerLogInController::class, 'login'])->name('lecturer.login.submit');

Route::get('student/login', [StudentLogInController::class, 'showLoginForm'])->name('student.login');
Route::post('student/login', [StudentLogInController::class, 'login'])->name('student.login.submit');


Route::get('admin/login', [AdminLogInController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLogInController::class, 'login'])->name('admin.login.submit');


Route::get('student/logout', [StudentLogInController::class, 'logout'])->name('student.logout');
Route::get('lecturer/logout', [LecturerLogInController::class, 'logout'])->name('lecturer.logout');
Route::get('admin/logout', [AdminLogInController::class, 'logout'])->name('admin.logout');


Route::put('/student/dashboard', [StudentProfileController::class, 'update']);
Route::put('/lecturer/dashboard', [LecturerProfileController::class, 'update']);


Route::middleware(['auth:lecturer'])->group(function () {
    Route::get('/lecturer/dashboard/courses', [LecturerProfileController::class, 'showCourses'])->name('lecturer.courses');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard/activity', [AdminProfileController::class, 'userActivity'])->name('admin.dashboard.activity');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard/server-logs', [AdminProfileController::class, 'serverLog'])->name('admin.dashboard.server-logs');
});

Route::post('/lecturer/dashboard/add-courses', [LecturerProfileController::class, 'addCourses']);
Route::delete('/lecturer/dashboard/courses/{course_id}', [LecturerProfileController::class, 'deleteCourse'])->name('lecturer.courses.delete');

Route::post('/student/course/add', [StudentProfileController::class, 'addCourse'])->name('student.course.add');


Route::get('/student/dashboard/feedback-lecturers', [StudentProfileController::class, 'fetchLecturers'])->name('student.feedback.lecturersName');
Route::get('/student/dashboard/feedback-courses/{lecturerId}', [StudentProfileController::class, 'fetchLecturerCourses'])->name('student.feedback.lecturersCourses');
Route::post('/student/dashboard/send-feedback', [StudentProfileController::class, 'giveFeedback']);


Route::get('/lecturer/feedback', [LecturerProfileController::class, 'showFeedback']);
Route::get('/lectures/{slug}', [CourseController::class, 'show'])->name('lecture.show');
Route::get('/lecturer/dashboard/evaluation',[LecturerProfileController::class, 'renderEvaluation']);


Route::get('/final-assessment/{slug}/take', [FinalAssessmentController::class, 'render'])->name('final_assessment.render');
Route::post('/final-assessment/store', [FinalAssessmentController::class, 'store'])->name('final_assessment.store');
Route::get('/final-assessment/students/{courseId}', [FinalAssessmentController::class, 'getStudents']);
Route::post('/final-assesment/lecturer/evaluate', [FinalAssessmentController::class, 'evaluate'])->name('final_assessment.evaluate');;

Route::get('/student/dashboard/mentorship',[StudentProfileController::class,'renderMentorship']);
Route::post('/student/dashboard/mentorship-apply', [StudentProfileController::class, 'applyMentorship'])->name('mentorship.apply');

Route::get('/lecturer/dashboard/mentorship',[LecturerProfileController::class,'renderMentorshipOverview']);
Route::post('/lecturer/dashboard/mentorship/process',[LecturerProfileController::class,'processMentorship']);
Route::get('/lecturer/dashboard/studentlist',[LecturerProfileController::class,'renderStudentList']);

Route::delete('/admin/dashboard/delete-std/{student_id}', [AdminProfileController::class, 'deleteStudent'])->name('admin.student.delete');
Route::delete('/admin/dashboard/delete-lect/{lecturer_id}', [AdminProfileController::class, 'deleteLecturer'])->name('admin.lecturer.delete');
Route::delete('/admin/dashboard/delete-course/{course_id}', [AdminProfileController::class, 'deleteCourse'])->name('admin.course.delete');

Route::put('/admin/dashboard/edit-std', [AdminProfileController::class, 'updateStudent'])->name('admin.student.update');
Route::put('/admin/dashboard/edit-lect', [AdminProfileController::class, 'updateLecturer'])->name('admin.lecturer.update');
Route::put('/admin/dashboard/edit-course', [AdminProfileController::class, 'updateCourse'])->name('admin.course.update');


Route::delete('/student/course/remove/{course_id}',[StudentProfileController::class ,'removeCourse'])->name('student.course.delete');