<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Admin;
use App\Models\Dev;
use App\Models\Gurdian;
use App\Models\Message;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


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
    public function addadmin(){
        $admin = Admin::all();
        return view("admin.admin1",compact("admin"));
    }

    public function dev(){
        $dev = Dev::all();
        return view("admin.dev",compact("dev"));
    }
    public function setting(){
        $user = Auth::user();
        return view("admin.setting",compact("user"));
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

//add student
    public function createStudent(Request $request){
      
        // Check if the email already exists in the users table
        $existingUser = User::where('email', $request->email)->first();
    
        if ($existingUser) {
            // Email already exists, display a message and redirect back to the form
            Session::flash('email_exists_error', 'Email already exists. Try with a different email.');
            return redirect()->back()->withInput();
        }


        $students = Student::all();
        
        $user = new user;
        $user->name=$request->fname;
        $user->email=$request->email;
        $user->role=2;
        $user->password=Hash::make('aaAA12!@');
        $user->save();


        $data = new student; 
        $data -> user_id = $user->id;                                                                                                   
        $data->first_name=$request->fname;
        $data->last_name=$request->lname;
        $data->email=$request->email;
        $data->birthday=$request->bday;
        $data->level=$request->level;
        $data->school=$request->school;
        $data->guardian_id=$request->guardian;
        $data->guardian_telno=$request->guardianno;
        $data->guardian_busniess=$request->guardian_busniess;
        $data->guardian_email=$request->guardian_email;
        $data->role=2;
        $data->password=Hash::make('aaAA12!@');
        $data->save();
    

        Session::flash('student_added_success', 'Student added successfully.');

        $parent = new gurdian;
        $parent -> student_id = $data->id;
        $parent->guardian_name=$request->guardian;
        $parent->guardian_telno=$request->guardianno;
        $parent->guardian_busniess=$request->guardian_busniess;
        $parent->guardian_email=$request->guardian_email;
        $parent->role=4;
        $parent->password=Hash::make('aaAA12!@');
        $parent->save();
      



       

        return redirect()->back();


    }





//delete student
public function deleteStudent(Request $request, $studentId)
{
    $student = Student::findOrFail($studentId);
    $userId = $student->user_id;

    // Delete the student from the 'students' table
    $student->delete();

    // Delete the associated user from the 'users' table using the relationship
    User::where('id', $userId)->delete();

    return redirect()->back()->with('success', 'Student deleted successfully');
}

//edit student

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
    $student->guardian_telno = $request->input('guardianno');
    $student->guardian_business = $request->input('guardian_busniess');
    // Update more student properties as needed

    $student->save();

    return redirect()->back()->with('success', 'Student updated successfully.');
}

//update subject
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

//add teacher

    public function createTeacher(Request $request){

         // Check if the email already exists in the users table
         $existingUser = User::where('email', $request->email)->first();
    
         if ($existingUser) {
             // Email already exists, display a message and redirect back to the form
             Session::flash('email_exists_error', 'Email already exists. Try with a different email.');
             return redirect()->back()->withInput();
         }
        $teachers = Teacher::all();
        
        $user = new User;
    $user->name = $request->fname;
    $user->email = $request->email;
    $user->role = 3;
    $user->password = Hash::make('bbBB12!@');
    $user->save();

    // Save teacher data with the correct user_id
    $teacher = new Teacher;
    $teacher->user_id = $user->id; // Set the user_id to the newly created user's id
    $teacher->first_name = $request->fname;
    $teacher->last_name = $request->lname;
    $teacher->email = $request->email;
    $teacher->level = $request->level;
    $teacher->school = $request->school;
    $teacher->role = 3;
    $teacher->password = Hash::make('bbBB12!@');
    $teacher->save();

    Session::flash('teacher_added_success', 'Student added successfully.');

        return redirect()->back();
    }

    public function deleteTeacher(Request $request, $teacherId){//remember to put this
        $teacher = Teacher::findOrFail($teacherId);//remember to put this
        $userId = $teacher->user_id;

        // Delete the teacher from the 'teachers' table
        $teacher->delete();

        // Delete the associated user from the 'users' table using the relationship
        User::where('id', $userId)->delete();

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



    public function createAdmin(Request $request){
        $admins = Admin::all();
        
        $data = new user;
        $data->name=$request->fname;
        $data->email=$request->email;
        $data->role=1;
        $data->password=Hash::make('aaAA12!@');
        $data->save();

        $data = new admin;
        $data->full_name=$request->fname;
        $data->email=$request->email;
        $data->telno=$request->no;
        $data->address=$request->address;
        $data->role=1;
        $data->password=Hash::make('aaAA12!@');
        $data->save();
    

        return redirect()->back()->with('success', 'Data added successfully to both databases.');



    }
    
    public function adddev(Request $request){

          // Check if the email already exists in the users table
          $existingUser = User::where('email', $request->email)->first();
    
          if ($existingUser) {
              // Email already exists, display a message and redirect back to the form
              Session::flash('email_exists_error', 'Email already exists. Try with a different email.');
              return redirect()->back()->withInput();
          }
        $developer = Dev::all();
        
        $data = new user;
        $data->name=$request->fname;
        $data->email=$request->email;
        $data->role=5;
        $data->password=Hash::make('aaAA12!@');
        $data->save();

        $data = new dev;
        $data->full_name=$request->fname;
        $data->email=$request->email;
        $data->telno=$request->telno;
        $data->Address=$request->add;
        $data->role=5;
        $data->password=Hash::make('aaAA12!@');
        $data->save();
    

        return redirect()->back()->with('success', 'Data added successfully to both databases.');



    }
    public function deleteDev($id){
        $data = dev::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function sendMessage(Request $request){
        $data = new Message;
        $data->topic=$request->topic;
        $data->description=$request->description;
        $data->sender=Auth::user()->id;
        $data->save();

        return redirect()->back();
    }

    public function updatep(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            // Add other profile fields validation here if needed
        ]);

        // Update the user's profile
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // Update other profile fields here if needed
        $user->save();

        // Redirect the user back to the profile page with a success message
        return redirect()->back();
    }

    public function updatepass(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password provided by the user matches their actual password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back();        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back(); 
       }

       public function changePassword(Request $request, $id){
        $data = User::find($id);

        $data->update([
            'password' => Hash::make($request->newpw),
        ]);
        
        return redirect()->back();
    }


    


    



}
