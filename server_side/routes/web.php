<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

//Routes
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

Route::get('/lecturer/dashboard', function () {
    return view('test_dashboard_lecturer'); 
})->name('/lecturer/dashboard');

Route::get('/student/dashboard', function () {
    return view('test_dashboard_student'); 
})->name('/student/dashboard');

Route::get('/admin/dashboard', function () {
    return view('test_dashboard_admin'); 
})->name('/admin/dashboard');


//Request Routes
use App\Http\Controllers\SignUpControllers\LecturerController;
Route::post('lecturers', [LecturerController::class, 'store'])->name('lecturer.store');


use App\Http\Controllers\SignUpControllers\StudentController;
Route::post('students', [StudentController::class, 'store'])->name('student.store');


use App\Http\Controllers\Auth\LogInControllers\LecturerLogInController;
Route::get('lecturer/login', [LecturerLogInController::class, 'showLoginForm'])->name('lecturer.login');
Route::post('lecturer/login', [LecturerLogInController::class, 'login'])->name('lecturer.login.submit');

use App\Http\Controllers\Auth\LogInControllers\StudentLogInController;
Route::get('student/login', [StudentLogInController::class, 'showLoginForm'])->name('student.login');
Route::post('student/login', [StudentLogInController::class, 'login'])->name('student.login.submit');

use App\Http\Controllers\Auth\LogInControllers\AdminLogInController;

Route::get('admin/login', [AdminLogInController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLogInController::class, 'login'])->name('admin.login.submit');
