<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Admin;
use App\Models\Dev;
use App\Models\Gurdian;
use App\Models\Message;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function admin(){
        $studentCount = Student::where('role', 2)->count();
        $teacherCount = Teacher::where('role', 3)->count();
        $adminCount = User::where('role', 1)->count();
        $developerCount = Dev::where('role', 5)->count();
        $parentCount = Gurdian::count();
        $messageCount = Message::count();
        $courseCount = Course::count();

        $users = User::all();
        $Student = Student::all();
        $Teacher = Teacher::all();
        $Admin = Admin::all();
        $Dev = Dev::all();
        $parent = Gurdian::all();
        $messages = Message::all();
        $course = Course :: all();
        // Retrieve all users

        return view('admin', compact('studentCount', 'teacherCount', 'adminCount', 'parentCount', 'developerCount', 'users','Admin','Dev','Student','Teacher','messages','messageCount','courseCount'));

    }
}
