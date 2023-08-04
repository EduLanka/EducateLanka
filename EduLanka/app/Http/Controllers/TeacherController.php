<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Courses of the logged-in teacher
        $courses = Course::where('teacher_id', $user->id)->get();

        //to group the students with the same ID and count them as 1
        $studentIds = StudentCourse::whereIn('course_id', $courses->pluck('id'))->pluck('student_id')->unique();

        $totalStudentCount = $studentIds->count();

        foreach ($courses as $course) {
            $averageScore = Assignment::where('course_id', $course->id)
                ->avg('marks');
            
            $course->average_score = $averageScore;
        }

        $courseCount = $courses->count();
        $students = Student::all();

        return view('teacher.teacher', compact('courses', 'courseCount', 'students', 'totalStudentCount'));
    }

    public function viewCourse()
    {    
        return view('teacher.course');
    }

    public function getStudentsByCourse($courseId)
    {
        //using join to get the student name from the student table using foreign keys
        $students = StudentCourse::where('course_id', $courseId)
            ->join('students', 'student_courses.student_id', '=', 'students.user_id')
            ->select('students.first_name', 'students.user_id as id')
            ->get();

            //calculating average score of each student

        foreach ($students as $student) {
            $averageScore = Assignment::where('student_id', $student->id)
                ->where('course_id', $courseId)
                ->avg('marks');
            
            $student->average_score = $averageScore;
        }

        return response()->json(['students' => $students]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
