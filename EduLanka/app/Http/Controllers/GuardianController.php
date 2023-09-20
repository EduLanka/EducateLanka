<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;
use App\Models\Submission;
use App\Models\Guardian;
use App\Models\SubmissionLink;
use App\Models\StudentCourse;
use Illuminate\Support\Facades\Auth;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
    
        // Get the student associated with the logged-in parent
        $student = Student::where('guardian_id', $user->id)->first();
    
        // Check if a student was found
        if ($student) {
            $courses = StudentCourse::where('student_id', $student->user_id)
                ->join('courses', 'student_courses.course_id', '=', 'courses.id')
                ->select('courses.level', 'courses.subject', 'courses.id','courses.teacher_id')
                ->get();
    
            $submissions = [];
            $courseAverages = [];
    
            foreach ($courses as $course) {
                // Retrieve submissions for each course
                $courseSubmissions = Submission::where('course_id', $course->id)
                    ->where('student_id', $student->user_id)
                    ->whereNotNull('total_marks')
                    ->get();

                    $totalMarks = 0;
                    $submissionCount = count($courseSubmissions);
        
                    foreach ($courseSubmissions as $submission) {
                        $totalMarks += $submission->total_marks;
                    }
        
                    $averageMarks = $submissionCount > 0 ? ($totalMarks / $submissionCount) : 0;
        
                    // Store course average in the courseAverages array
                    $courseAverages[$course->id] = $averageMarks;
    
                // Store course submissions in the submissions array
                $submissions[$course->id] = $courseSubmissions;
            }
    
            if ($courses) {
                return view('parent.parent', compact('courses', 'submissions','student','courseAverages'));
            } else {
                return 'no courses';
            }
        } else {
            return 'no student';
        }
    }

    public function getSubmissionDetails($submissionID) {
        // Fetch the submission details from the database using Eloquent
        $submission = Submission::find($submissionID);
    
        if ($submission) {
            return [
                'title' => $submission->title,
                'upload_date' => $submission->upload_date,
                'total_marks' => $submission->total_marks,
                'grade' => $submission->grade,
                'feedback' => $submission->feedback,
            ];
        } else {
            return null; // Handle the case where the submission is not found
        }
    }

    public function getCount($courseID) {
        $course = Course::find($courseID);
    
        if ($course) {
            $linkCount = SubmissionLink::where('course_id', $courseID)->count();
    
            return response()->json(['linkCount' => $linkCount]);
        }
    
        return response()->json(['linkCount' => 0]); 
    }

public function getDueCount($courseID) {
    $course = Course::find($courseID);
    
    if ($course) {
        // Get the current date
        $currentDate = now();

        // Use a where clause to count the due links based on their due_date
        $dueLinkCount = SubmissionLink::where('course_id', $courseID)
            ->whereDate('dueDate', '<', $currentDate)
            ->count();

        return response()->json(['dueLinkCount' => $dueLinkCount]);
    }

    return response()->json(['dueLinkCount' => 0]);
}
    
    public function getPerformance(Request $request)
    {
        $courseId = $request->input('courseId');
        $studentId = auth()->user()->id; // Replace this with the actual way to get the student's ID
    
        
    
        return view('performance', compact('submissions'));
    }

    public function settings()
    {    
        $user = Auth::user();
        $details = Guardian::where('id',$user->id)->get();
         

        $student = Student::where('guardian_id', $user->id)->first();
    
        // Check if a student was found
        if ($student) {
            $courses = StudentCourse::where('student_id', $student->user_id)
                ->join('courses', 'student_courses.course_id', '=', 'courses.id')
                ->select('courses.level', 'courses.subject', 'courses.id','courses.teacher_id')
                ->get();
    
            $submissions = [];
            $courseAverages = [];
    
            foreach ($courses as $course) {
                // Retrieve submissions for each course
                $courseSubmissions = Submission::where('course_id', $course->id)
                    ->where('student_id', $student->user_id)
                    ->whereNotNull('total_marks')
                    ->get();

                    $totalMarks = 0;
                    $submissionCount = count($courseSubmissions);
        
                    foreach ($courseSubmissions as $submission) {
                        $totalMarks += $submission->total_marks;
                    }
        
                    $averageMarks = $submissionCount > 0 ? ($totalMarks / $submissionCount) : 0;
        
                    // Store course average in the courseAverages array
                    $courseAverages[$course->id] = $averageMarks;
    
                // Store course submissions in the submissions array
                $submissions[$course->id] = $courseSubmissions;
            }
    
            if ($courses) {
                return view('parent.settings', compact('courses', 'submissions','student','courseAverages', 'details'));
            } else {
                return 'no courses';
            }
        } else {
            return 'no student';
        }
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
