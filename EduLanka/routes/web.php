<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//connecting middleware since ther is no login through controller we add the function here
Route::get('admin',function(){
    return view('admin');
})->name('admin')->middleware('admin');

Route::get('student',function(){
    return view('student');
})->name('student')->middleware('student');

Route::get('teacher',function(){
    return view('teacher');
})->name('teacher')->middleware('teacher');

Route::get('parent',function(){
    return view('parent');
})->name('parent')->middleware('parent');

Route::get('developer',function(){
    return view('developer');
})->name('developer')->middleware('developer');

//to get the database deatils shown when the admin dashboard open
Route::get('admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');

//Admin:- to go to course page in admin
Route::get("/course",[AdminController::class,"addcourse"]);

Route::get("/students",[AdminController::class,"addstudent"]);

Route::get("/teachers",[AdminController::class,"addteacher"]);

Route::post("/uploadcourse",[AdminController::class,"uploadcourse"]);
Route::get("/deletecourse/{id}",[AdminController::class, 'deletecourse']);
Route::post('/update', 'App\Http\Controllers\AdminController@update')->name('update');



Route::post("/createStudent",[AdminController::class,"createStudent"]);
Route::get("/deleteStudent/{id}",[AdminController::class,"deleteStudent"]);
Route::post('/updatestudent', 'App\Http\Controllers\AdminController@updatestu')->name('updatestu');



Route::post("/createTeacher",[AdminController::class,"createTeacher"]);
Route::get("/deleteTeacher/{id}",[AdminController::class,"deleteTeacher"]);


