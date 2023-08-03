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

Route::middleware(['student'])->group(function () {
    Route::get('student', function () {
        return view('student');
    })->name('student');
});

Route::middleware(['teacher'])->group(function () {
    Route::get('/teacher', [App\Http\Controllers\TeacherController::class, 'index'])->name('teacher.index');

});

Route::middleware(['parent'])->group(function () {
    Route::get('parent', function () {
        return view('parent');
    })->name('parent');
});

Route::middleware(['developer'])->group(function () {
    Route::get('developer', function () {
        return view('developer');
    })->name('developer');
});

Route::post("/sendMessage",[AdminController::class,"sendMessage"]);
Route::post("/changePassword/{id}",[AdminController::class,"changePassword"]);

// Admin dashboard and other admin routes
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Admin routes for courses, students, teachers, etc.
    Route::get("/course",[AdminController::class,"addcourse"]);
    Route::get("/students",[AdminController::class,"addstudent"]);
    Route::get("/teachers",[AdminController::class,"addteacher"]);
    Route::get("/admins",[AdminController::class,"addadmin"]);

    Route::post("/uploadcourse",[AdminController::class,"uploadcourse"]);
    Route::get("/deletecourse/{id}",[AdminController::class, 'deletecourse']);
    Route::post('/update', 'App\Http\Controllers\AdminController@update')->name('update');

    Route::post("/createStudent",[AdminController::class,"createStudent"]);
    Route::get("/deleteStudent/{id}",[AdminController::class,"deleteStudent"]);
    Route::post('/updatestudent', 'App\Http\Controllers\AdminController@updatestu')->name('updatestu');

    Route::post("/createTeacher",[AdminController::class,"createTeacher"]);
    Route::get("/deleteTeacher/{id}",[AdminController::class,"deleteTeacher"]);
    Route::post('/updatetech', 'App\Http\Controllers\AdminController@updatetech')->name('updatetech');

    Route::post("/createAdmin",[AdminController::class,"createAdmin"]);

    Route::post("/replyMessage/{id}",[AdminController::class,"replyMessage"]);

    Route::middleware('auth')->group(function () {
        Route::get("/setting",[AdminController::class,"setting"]);
        Route::put('/profile', [AdminController::class,"updatep"])->name('updatep');
        Route::post('/changepassword', [AdminController::class,"updatepass"])->name('updatepass');
    });

    Route::get("/banner",[AdminController::class,"banner"]);
    Route::post("/uploadbanner",[AdminController::class,"uploadbanner"]);
    Route::get("/deleteadvert/{id}",[AdminController::class,"deleteadvert"]);
    Route::post('/updateadvert', 'App\Http\Controllers\AdminController@updateadvert')->name('updateadvert');

   
});
