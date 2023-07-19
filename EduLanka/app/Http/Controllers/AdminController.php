<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
    public function addcourse(){
        $data=course::all();
        return view("admin.course",compact("data"));
    }
    public function addstudent(){
        $students = Student::all();
        return view("admin.student1",compact("students"));
    }
    public function addteacher(){
        $teachers = Teacher::all();
        return view("admin.teacher1",compact("teachers"));
    }

    public function uploadcourse(Request $request){
        $data = new course;
        $data->level=$request->level;
        $data->subject=$request->subject;
        $data->save();
        return redirect()->back();
    }

    public function deletecourse($id){

        $data=course::find($id);
        $data->delete();
        return redirect()->back();
    }


    public function createStudent(Request $request){
        $students = Student::all();
        
        $data = new user;
        $data->name=$request->fname;
        $data->email=$request->email;
        $data->role=2;
        $data->password=Hash::make('aaAA12!@');
        $data->save();

        $data = new student;
        $data->first_name=$request->fname;
        $data->last_name=$request->lname;
        $data->email=$request->email;
        $data->birthday=$request->bday;
        $data->level=$request->level;
        $data->school=$request->school;
        $data->guardian_id=$request->guardian;
        $data->role=2;
        $data->password=Hash::make('aaAA12!@');
        $data->save();
    

        return redirect()->back()->with('success', 'Data added successfully to both databases.');



    }
    public function update(Request $request)
{
    $itemId = $request->input('itemId');
    $data = Course::findOrFail($itemId);

    $data->level = $request->input('level');
    $data->subject = $request->input('subject');
    // Update more item properties as needed

    $data->save();

    return redirect()->back()->with('success', 'Item updated successfully.');
}




    public function deleteStudent($id){
        $data = student::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function updatestu(Request $request)
{
    $studentId = $request->input('studentId');
    $student = Student::findOrFail($studentId);

    $student->first_name = $request->input('first_name');
    $student->last_name = $request->input('last_name');
    $student->email = $request->input('email');
    $student->birthday = $request->input('birthday');
    $student->level = $request->input('level');
    $student->school = $request->input('school');
    $student->guardian_id = $request->input('guardian_id');
    // Update more student properties as needed

    $student->save();

    return redirect()->back()->with('success', 'Student updated successfully.');
}




    public function createTeacher(Request $request){
        $teachers = Teacher::all();
        
        $data = new user;
        $data->name=$request->fname;
        $data->email=$request->email;
        $data->role=3;
        $data->password=Hash::make('bbBB12!@');
        $data->save();

        $data = new teacher;
        $data->first_name=$request->fname;
        $data->last_name=$request->lname;
        $data->email=$request->email;
        $data->level=$request->level;
        $data->school=$request->school;
        $data->role=3;
        $data->password=Hash::make('bbBB12!@');
        $data->save();

        return redirect()->back();
    }

    public function deleteTeacher($id){
        $data = teacher::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function updatetech(Request $request)
    {   
    $teacherId = $request->input('teacher_id');
    // Retrieve the teacher from the database
    $teacher = Teacher::find($teacherId);
  
    // Update the teacher details with the submitted form data
    $teacher->first_name = $request->input('first_name');
    $teacher->last_name = $request->input('last_name');
    $teacher->email = $request->input('email');
    $teacher->level = $request->input('level');
    $teacher->school = $request->input('school');
  
    // Save the updated teacher details
    $teacher->save();
        return redirect()->back()->with('success', 'Teacher updated successfully.');
    }
    



}
