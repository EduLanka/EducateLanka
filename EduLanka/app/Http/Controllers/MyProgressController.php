<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyProgressController extends Controller
{
    public function index()
    {
        return view('student.my-progress'); 
    }
}
