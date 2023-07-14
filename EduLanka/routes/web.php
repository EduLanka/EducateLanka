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