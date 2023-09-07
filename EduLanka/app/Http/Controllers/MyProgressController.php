<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Student;
use App\Models\Submission;
use App\Models\SubmissionLink;
use App\Models\StudentCourse;

class MyProgressController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $courses = StudentCourse::where('student_id', $user->id)
        ->join('courses', 'student_courses.course_id', '=', 'courses.id')
        ->select('courses.level', 'courses.subject', 'courses.id', 'courses.teacher_id')
        ->get();

    $submissions = [];
    $courseAverages = [];
    
    $gradesCount = [
        'A' => 0,
        'B' => 0,
        'C' => 0,
        'D' => 0,
        'E' => 0,
        'F' => 0,
    ];

    foreach ($courses as $course) {
        // Retrieve submissions for each course
        $courseSubmissions = Submission::where('course_id', $course->id)
            ->where('student_id', $user->id)
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

        // Calculate the grades count for this course
        foreach ($courseSubmissions as $submission) {
            if ($submission->grade) {
                $gradesCount[$submission->grade]++;
            }
        }
    }

    if ($courses->isEmpty()) {
        return 'no courses';
    }

    return view('student.my-progress', compact('courses', 'courseAverages', 'gradesCount'));
}
    
}
