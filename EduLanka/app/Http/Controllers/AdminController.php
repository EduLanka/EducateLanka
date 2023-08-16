<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Admin;
use App\Models\Guardian;
use App\Models\Message;
use App\Models\Advert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class AdminController extends Controller
{
    public function index(){
        $studentCount = Student::where('role', 2)->count();
        $teacherCount = Teacher::where('role', 3)->count();
        $adminCount = User::where('role', 1)->count();
        $parentCount = Guardian::count();
        $messageCount = Message::count();
        $courseCount = Course::count();
        $bannerCount = Advert::count();

        $users = User::all();
        $Student = Student::all();
        $Teacher = Teacher::all();
        $Admin = Admin::all();
        $parent = Guardian::all();
        $messages = Message::all();
        $course = Course :: all();
        // Retrieve all users

        return view('admin', compact('studentCount', 'teacherCount', 'adminCount', 'parentCount','bannerCount'  ,'users','Admin','Student','Teacher','messages','messageCount','courseCount'));
    }
    
    public function addcourse(){
        $data=course::all();
        $teachers = Teacher::all();
        return view("admin.course",compact("data","teachers"));
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

    public function setting(){
        $user = Auth::user();
        return view("admin.setting",compact("user"));
    }


    public function uploadcourse(Request $request){
        $data = new course;
        $data->level=$request->level;
        $data->subject=$request->subject;
        $data->teacher_id=$request->teacher_id;
        $data->save();
        Session::flash('student_added_success', 'Course added successfully.');
        
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

    
        try {
            $user = new User;
            $user->name = $request->fname;
            $user->email = $request->email;
            $user->role = 2;
            $user->password = Hash::make('aaAA12!@');
            $user->save();
            
            $guardian = new Guardian;
            $guardian->guardian_name = $request->guardian;
            $guardian->guardian_telno=$request->guardianno;
            $guardian->guardian_busniess=$request->guardian_busniess;
            $guardian->guardian_email=$request->guardian_email;
            $guardian->save();

            $parentUser = new User;
            $parentUser->id = $guardian->id;
            $parentUser->name = $guardian->guardian_name;
            $parentUser->email = $guardian->guardian_email;
            $parentUser->role = 4;
            $parentUser->password = Hash::make('ggGG12!@');
            $parentUser->save();

            $student = new Student;
            $student->user_id = $user->id;
            $student->first_name = $request->fname;
            $student->last_name = $request->lname;
            $student->email = $request->email;
            $student->birthday = $request->bday;
            $student->level = $request->level;
            $student->guardian_id = $guardian->id;
            $user->role = 2;
            $user->password = Hash::make('aaAA12!@');
            $student->save();
            

            
            Session::flash('student_added_success', 'Student added successfully.');
        } catch (\Exception $e) {

            
            // Handle the error here
            // You might want to show an error message or log the error
            Log::error($e->getMessage());
            
            Session::flash('student_added_error', 'An error occurred while adding the student.');
        }
    
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
    $student->guardian_id = $request->input('guardian_id');

    // Update more student properties as needed
    Session::flash('student_edit_success', 'Student upadted successfully.');

    $student->save();

    $user = $student->user;
    $user->name = $request->input('first_name');
    $user->email = $request->input('email');
    $user->save();

    return redirect()->back()->with('success', 'Student updated successfully.');
}

//update subject
public function update(Request $request)
{
    $itemId = $request->input('itemId');
    $data = Course::findOrFail($itemId);

    $data->level = $request->input('level');
    $data->subject = $request->input('subject');
    $data->teacher_id = $request->input('teacher_id');
    // Update more item properties as needed

    $data->save();
    Session::flash('course_edit_success', 'Course updated successfully.');

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
        $teacher->no = $request -> no;
        $teacher->level = implode(',', $request->input('level'));
        $teacher->role = 3;
        $teacher->password = Hash::make('bbBB12!@');
        $teacher->save();

        Session::flash('teacher_added_success', 'Teacher added successfully.');

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
    $teacher = Teacher::findOrFail($teacherId);
  
    // Update the teacher details with the submitted form data
    $teacher->first_name = $request->input('first_name');
    $teacher->last_name = $request->input('last_name');
    $teacher->email = $request->input('email');
    $teacher->no = $request->input('no');
    $teacher->level = implode(',', $request->input('level'));
  
    // Save the updated teacher details
    
    $teacher->save();
    Session::flash('teacher_edit_success', 'Teacher upadted successfully.');

    $user = $teacher->user;
    $user->name = $request->input('first_name');
    $user->email = $request->input('email');
    $user->save();

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
    
   

    public function sendMessage(Request $request){
        $data = new Message;
        $data->topic=$request->topic;
        $data->description=$request->description;
        $data->sender=Auth::user()->id;
        $data->save();

        return redirect()->back();
    }
    
//admin profile update
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
        return redirect("admin");
    }
    //change password for admin

    public function updatepass(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $user = Auth::user();
    
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
    
        $user->password = Hash::make($request->password);
        $user->save();

        Auth::logout();
    
        session()->flash('success', 'Password changed successfully.');
    
        return redirect('/login');
       }


//passwrod change to student,teacher,developer
       public function changePassword(Request $request, $id){
        $data = User::find($id);

        $data->update([
            'password' => Hash::make($request->newpw),
        ]);
        
        Session::flash('success', 'Password updated successfully!');
        Auth::logout();

        return redirect()->back();
        // return redirect('/login');
    }


//reply message fron admin
    public function replyMessage(Request $request, $id){
        $data = Message::find($id);

        $data->update([
            'reply' => $request->reply,
        ]);
        
        return redirect()->back();
    }

 //announcments add,delete.update,retive code
    public function banner(){
        $advert = Advert::all();
        return view("admin.banner",compact('advert'));
    }
    public function uploadbanner(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed image types and size as needed
        ]);
    
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('EduLanka\public\advert'), $imageName);
    
        Advert::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
        ]);
    
        return redirect()->back()->with('success', 'Advertisement added successfully.');
    }

    public function deleteadvert($id){
        $advert=advert::find($id);
        $advert->delete();
        return redirect()->back();
    }
    public function updateadvert(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'new_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $advertId = $request->input('advert_id');
        $advert = Advert::findOrFail($advertId);

        $advert->name = $request->input('name');
        $advert->description = $request->input('description');

        if ($request->hasFile('new_image')) {
            $imageName = time() . '.' . $request->file('new_image')->getClientOriginalExtension();
            $request->file('new_image')->move(public_path('EduLanka/public/advert'), $imageName);
            $advert->image = $imageName;
        }

        $advert->save();

        return redirect()->back()->with('success', 'Advertisement updated successfully.');
    }
//end of announcments code

    }



  


