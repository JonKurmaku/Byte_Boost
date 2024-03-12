<?php

use Illuminate\Support\Facades\Route;

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