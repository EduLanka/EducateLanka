<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

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
    public function admin()
    {
        $studentCount = User::where('role', 2)->count();
        $teacherCount = User::where('role', 3)->count();
        $adminCount = User::where('role', 1)->count();
        $parentCount = User::where('role', 4)->count();
        $developerCount = User::where('role', 4)->count();

        return view('admin', [
            'studentCount' => $studentCount,
            'teacherCount' => $teacherCount,
            'adminCount' => $adminCount,
            'parentCount' => $parentCount,
            'developerCount' => $developerCount,
        ]);
    }
}
