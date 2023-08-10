@extends('layouts.teacherLayout')

@section('content')
<p><b>SETTINGS</b></p>
<div class="settings-container">
    <div class="profile">
        <div class="basics">
            <img src="{{ asset('assets/images/userImage.jpg') }}" alt="user image">

            <div class="basic-d">
                @foreach($teacherdetails as $teacher)
                <p><b>ID:</b> {{$teacher->user_id}}</p>
                <p><b>Full Name:</b> {{$teacher->first_name}} {{$teacher->last_name}}</p>
                <p><b>Email address:</b> {{$teacher->email}}</p>
                <p><b>Mobile number:</b> {{$teacher->no}}</p>
                <p><b>Role:</b> Teacher</p>
                @endforeach
            </div>

        </div>
    
        <br>
        <p><b>My Courses:</b></p>
        <div class="my-courses">
            @foreach($courses as $course)
            <div class="coursee" style="background-color: {{ '#' . substr(md5(rand()), 0, 6) }};height:fit-content;">
                <p>{{$course -> level}} : {{$course -> subject}}</p>
            </div>
            @endforeach
        </div>
       

        <br>
        <p class="info"><b>You cannot edit your profile details. Please contact admin for more information.</b></p>
    </div>
    <div class="changeP">
        <p><b>Change password</b></p>
        <form method="POST" action="{{ route('change-password', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <!--form start -->
            <div class="mb-3">
            <label for="oldpw" class="form-label">Old Password</label>
            <input id="oldPassword" type="password" class="form-control" name = "oldpw" placeholder="Enter your old password">
            <p id="confirmOldPassword" style="color: red; display: none;">Incorrect password</p>
            </div>
            
            <div class="mb-3">
            <label for="newpw" class="form-label">New Password</label>
            <input type="password" class="form-control" id="psw" name="newpw" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required placeholder="Enter a password that meets the criteria">
            </div>
            <div id="criteria">
            New password must contain the following:
            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
            <p id="number" class="invalid">A <b>number</b></p>
            <p id="specialChar" class="invalid">A <b>special character</b></p>
            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>
            <div class="mb-3">
                <label for="cpw" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" name="cpw" id="confirmPassword" placeholder="Re-enter new password">
                <p id="confirmErrorMessage" style="color: red; display: none;">Passwords do not match</p>
            </div>

            
            <!-- end of form -->

        </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

@endsection