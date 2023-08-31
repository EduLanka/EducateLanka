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

use Spatie\LaravelIgnition\Recorders\QueryRecorder\Query;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
    
        // Courses of the logged-in student
        $courses = StudentCourse::where('student_id', $user->id)
            ->join('courses', 'student_courses.course_id', '=', 'courses.id')
            ->select('courses.level', 'courses.subject', 'courses.id')
            ->get();
    
        $courseCount = StudentCourse::where('student_id', $user->id)->count();
        
        // Calculate the count of due assignments not submitted by the student
        $notSubmittedCount = SubmissionLink::whereHas('submissions', function ($query) use ($user) {
            $query->where('student_id', $user->id);
        }, '<', 1)->count();


    
        return view('student.student', compact('courses', 'courseCount', 'notSubmittedCount'));
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

    public function settings()
    {    
        $user = Auth::user();
        $studentdetails = Student::where('user_id',$user->id)->get();
        // $courses = StudentCourse::where('student_id', $user->id)->get();
        $courses = StudentCourse::where('student_id', $user->id)
            ->join('courses', 'student_courses.course_id', '=', 'courses.id')
            ->select('courses.level','courses.subject')
            ->get(); 

        return view('student.settings', compact('studentdetails','courses'));
    }


    public function viewCourse($courseId) {
        $course = Course::find($courseId);
    
        if (!$course) {
            return abort(404);
        }

        $user = Auth::user();

        $submissions = Submission::where('course_id', $courseId)
        ->where('student_id', $user->id)
        ->whereNotNull('total_marks') // Only fetch submissions with non-null marks
        ->get();
    
        $instructor = Teacher::where('user_id', $course->teacher_id)->first();
        $coursematerials = CourseMaterial::where('course_id',$courseId)->get();
        $links = SubmissionLink::where('course_id',$courseId)->get();
    
       return view('student.courseView', compact('course', 'instructor', 'courseId', 'coursematerials', 'links', 'submissions'));
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

    // public function search(Request $request)
    // {
    //     $courses = StudentCourse::where('student_id', Auth::user()->id)
    //         ->join('courses', 'student_courses.course_id', '=', 'courses.id')
    //         ->select('courses.level', 'courses.subject', 'courses.id')
    //         ->get();
    
    //     $courseCount = StudentCourse::where('student_id', Auth::user()->id)->count();
    //     $search_text = $request->input('query'); // Use the request helper to get the query parameter
    // $course = Course::where('subject', 'LIKE', '%' . $search_text . '%')->get();
    
    //     return view('student.student', compact('course', 'courses', 'courseCount'));
    // }
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $courses = Course::where('subject', 'like', '%' . $query . '%')->get();

        return response()->json(['courses' => $courses]);
    }

    public function getSubmissionData(Request $request)
{
    $courseId = $request->input('courseId');
    $studentId = $request->input('studentId');

    // Fetch submission data from the database based on courseId and studentId
    $submissionData = Submission::where('course_id', $courseId)
        ->where('student_id', $studentId)
        ->get();

    return response()->json($submissionData);
}



}
