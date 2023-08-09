<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\CourseMaterial;
use App\Models\SubmissionLink;
use App\Models\Teacher;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    }

    public function viewCourses(){

        //details of courses the student is enrolled in
        $courses = StudentCourse::where('student_id', Auth::user()->id)
        ->join('courses', 'student_courses.course_id', '=', 'courses.id')
        ->select('courses.level','courses.subject', 'courses.id')
        ->get();

        //all courses that matches the level of the student
        $allCourses = Student::where('user_id', Auth::user()->id)
        ->join('courses', 'Students.level', '=', 'courses.level')
        ->select('courses.level','courses.subject', 'courses.id', 'courses.teacher_id')
        ->get();


        return view('student.courses', compact('courses','allCourses'));
    }


    public function enroll($courseId)
    {
        if (auth()->check()) {
            StudentCourse::create([
                'student_id' => auth()->user()->id,
                'course_id' => $courseId,
            ]);
    
            Session::flash('success', 'You are enrolled in this course');
    
            return redirect('/student/courses');
        } else {
            // Handle unauthenticated user
        }
        
    }

    public function unenroll($courseId)
    {
        //have to take enrollment id
       
    }

    public function viewCourse($courseId) {
        $course = Course::find($courseId);
    
        if (!$course) {
            return abort(404);
        }
    
        $instructor = Teacher::where('user_id', $course->teacher_id)->first();
        $coursematerials = CourseMaterial::where('course_id',$courseId)->get();
        $links = SubmissionLink::where('course_id',$courseId)->get();
    
        return view('student.courseView', compact('course', 'instructor','courseId','coursematerials','links'));
    }

    public function downloadCourseMaterial($materialId)
    {
        $material = CourseMaterial::find($materialId);

        if (!$material) {
            // Handle material not found, return an error response or redirect
        }

        $filePath = public_path('EduLanka/public/materials/' . $material->content);
        
        return response()->download($filePath, $material->title . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }

    public function addSubmission($courseId, $linkId, Request $request)
    {
        $fileName = time() . '.' . $request->content->getClientOriginalExtension();
        $request->content->move(public_path('EduLanka\public\submissions'), $fileName);

        Submission::create([
            'title' => $request->title,
            'content' => $fileName,
            'course_id' => $courseId,
            'link_id' => $linkId,
            'student_id' => Auth::user()->id,
        ]);

        Session::flash('success', 'Assignment submitted successfully! Good Luck!');

        return redirect()->back();
    }


    
}
