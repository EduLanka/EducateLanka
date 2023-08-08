<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\Assignment;
use App\Models\SubmissionLink;
use App\Models\Submission;
use App\Models\CourseMaterial;
use App\Models\Advert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $user = Auth::user();

        // Courses of the logged-in teacher
        $courses = Course::where('teacher_id', $user->id)->get();

        return view('teacher.course',compact('courses'));
    }

    public function getStudentsByCourse($courseId)
    {
        //using join to get the student name from the student table using foreign keys
        $students = StudentCourse::where('course_id', $courseId)
            ->join('students', 'student_courses.student_id', '=', 'students.user_id')
            ->select('students.first_name','students.last_name', 'students.user_id as id')
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

    public function getSubmissions($courseId)
    {

        $submissions = Submission::where('course_id', $courseId)->get();

        return response()->json(['submissions' => $submissions]);
    }

    public function getSubmissionDet($submissionId)
    {

        $submission_details = Submission::where('id', $submissionId)->get();

        return response()->json(['submission_details' => $submission_details]);
    }

    

    public function markSubmission(Request $request)
{
    try {
        $request->validate([
            'marks' => 'required|integer',
            'grade' => 'required|string',
            'feedback' => 'required|string',
        ]);

        $submissionId = $request->input('id');
        $submission = Submission::findOrFail($submissionId);

        $submission->update([
            'total_marks' => $request->marks,
            'grade' => $request->grade,
            'feedback'=> $request->feedback
        ]);

        Session::flash('success', 'Submission marked successfully');

        return redirect('/teacher/courses');
    } catch (\Exception $e) {
        // Log the error or handle it in some way
        return response()->json(['error' => 'An error occurred while updating submission details.']);
    }
}




    public function addMaterial(Request $request){
        $fileName = time() . '.' . $request->content->getClientOriginalExtension();
        $request->content->move(public_path('EduLanka\public\materials'), $fileName);

        CourseMaterial::create([
            'material_type' => $request->type,
            'title' => $request->title,
            'content' => $fileName,
            'course_id' => $request->course,
        ]);

        Session::flash('success', 'Course material has been uploaded successfully!');

        return redirect()->back();
    }


    public function addLink(Request $request){
        CourseMaterial::create([
            'material_type' => $request->type,
            'title' => $request->title,
            'content' => $request->content,
            'course_id' => $request->course,
        ]);

        Session::flash('success', 'External Link has been added successfully!');

        return redirect('/teacher');
    }

    public function addannounce(Request $request)
    {
    
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('EduLanka\public\advert'), $imageName);
    
        Advert::create([
            'name' => $request->name,
            'description' => $request->desc,
            'image' => $imageName,
        ]);
    
        Session::flash('success', 'Announcement has been added successfully!');

        return redirect('/teacher');
    }

    public function addSubLink(Request $request){
        SubmissionLink::create([
            'title' => $request->title,
            'description' => $request->desc,
            'dueDate' => $request->date,
            'marks_available' => $request->marks,
            'course_id' => $request->course,
        ]);

        Session::flash('success', 'Assignment Submission Link has been added successfully!');

        return redirect('/teacher');
    }

    public function getCourseMaterials($courseId, $materialType)
    {
        $courseMaterials = CourseMaterial::where('course_id', $courseId)
            ->where('material_type', $materialType)
            ->get();
        
        return response()->json($courseMaterials);
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

    public function deleteCourseMaterial($materialId)
    {
        $material = CourseMaterial::find($materialId);
        $material->delete();
        return redirect()->back()->with('success', 'Course material has been deleted successfully!');
        // Session::flash('success', 'Course material has been deleted successfully!');
        
    }

    //not workingggggg
    public function editCourseMaterial(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $materialId = $request->input('materialId');
        $material = CourseMaterial::findOrFail($materialId);

        $material->title = $request->input('materialTitle');

        $material->save();

        return redirect()->back()->with('success', 'Advertisement updated successfully.');
    }

    public function downloadSubmission($subId)
    {
        $submission = Submission::find($subId);

        if (!$submission) {
            // Handle material not found, return an error response or redirect
        }

        $filePath = public_path('EduLanka/public/submissions/' . $submission->content);
        
        return response()->download($filePath, $submission->title . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }


}
