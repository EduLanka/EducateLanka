<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    
    public function addcourse(){
        return view("admin.course");
    }
    public function addstudent(){
        return view("admin.student1");
    }
    public function addteacher(){
        return view("admin.teacher1");
    }
}
