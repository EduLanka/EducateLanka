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
    if (auth()->check()) {
        if (auth()->user()->role == 2) {
            return redirect()->route('student');
        } elseif (auth()->user()->role == 3) {
            return redirect()->route('teacher.index');
        } elseif (auth()->user()->role == 4) {
            return redirect()->route('parent');
        }  elseif (auth()->user()->role == 1) {
            return redirect()->route('admin.index');
        }
    }
    
    return redirect()->route('login'); // Redirect to login if not authenticated
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['student'])->group(function () {
    Route::get('student', function () {
        return view('student');
    })->name('student');

    Route::get('/student/courses', 'App\Http\Controllers\StudentController@viewCourses')->name('student.courses');

    Route::post('/enroll/{courseId}', 'App\Http\Controllers\StudentController@enroll')->name('enroll.course');

    Route::delete('/enroll/{courseId}', 'App\Http\Controllers\StudentController@unenroll')->name('unenroll.course');

    Route::get('/courses/view/{courseId}', 'App\Http\Controllers\StudentController@viewCourse')->name('viewCourse');

    Route::get('/download/{materialId}', 'App\Http\Controllers\StudentController@downloadCourseMaterial')->name('download');

    Route::post('/add-submission/{courseId}/{linkId}', 'App\Http\Controllers\StudentController@addSubmission')->name('student.submission.add');



});

Route::middleware(['teacher'])->group(function () {
    Route::get('/teacher', [App\Http\Controllers\TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/teacher/courses', 'App\Http\Controllers\TeacherController@viewCourse', 'index')->name('teacher.courses');

    Route::get('/teacher/settings', 'App\Http\Controllers\TeacherController@settings')->name('teacher.settings');

    Route::get('/get-students/{courseId}', 'App\Http\Controllers\TeacherController@getStudentsByCourse');

    Route::post('/teacher/materials/add', 'App\Http\Controllers\TeacherController@addMaterial')->name('teacher.material.add');

    Route::post('/teacher/materials/addlink', 'App\Http\Controllers\TeacherController@addLink')->name('teacher.material.addlink');

    Route::post('/teacher/announcements/add', 'App\Http\Controllers\TeacherController@addannounce')->name('teacher.announce.add');

    Route::post('/teacher/submission/addlink', 'App\Http\Controllers\TeacherController@addSubLink')->name('teacher.sublink.add');

    Route::get('/get-course-materials/{courseId}/{materialType}', 'App\Http\Controllers\TeacherController@getCourseMaterials');

    Route::get('/download-material/{materialId}', 'App\Http\Controllers\TeacherController@downloadCourseMaterial')->name('teacher.material.download');

    Route::get('/delete-material/{materialId}', 'App\Http\Controllers\TeacherController@deleteCourseMaterial')->name('teacher.material.delete');

    Route::put('/edit-material', 'App\Http\Controllers\TeacherController@editCourseMaterial')->name('teacher.material.edit');

    Route::get('/get-submissions/{courseId}', 'App\Http\Controllers\TeacherController@getSubmissions');

    Route::get('/get-submissions-details/{submissionId}', 'App\Http\Controllers\TeacherController@getSubmissionDet');

    Route::get('/download-submission/{subId}', 'App\Http\Controllers\TeacherController@downloadSubmission')->name('teacher.sub.download');

    Route::put('/mark-submission', 'App\Http\Controllers\TeacherController@markSubmission')->name('teacher.sub.grade');


    // Route::post('/grade-submission/{submissionId}', 'App\Http\Controllers\TeacherController@gradeSubmission')->name('teacher.sub.grade');



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
Route::post("/changePassword/{id}",[AdminController::class,"changePassword"])->name('change-password');

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

//forum
Route::get('/forums', 'App\Http\Controllers\ForumController@index')->name('forum');
Route::get('/forums/{id}', 'App\Http\Controllers\ForumController@show');
Route::get('/forums/{id}/posts', 'App\Http\Controllers\ForumController@getPosts');
Route::post('/forums/create', 'App\Http\Controllers\ForumController@create')->name('create-forum');
Route::post('/forums/post/{forumId}', 'App\Http\Controllers\ForumController@sharePost')->name('share-post');

