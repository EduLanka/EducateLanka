<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/setting.css">
	<title>Document</title>
</head>
<body>
<div class="container">
        <header>Settings</header>
        <form action="{{ route('updatep') }}" method="POST">
    @csrf
    @method('PUT')
            <div class="form first">
                <div class="details personal">
                    <span class="title">Edit Profile</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Full Name</label>
                            <input type="text" placeholder="Enter your first name" name="name" value="{{ $user->name }}" required>
                        </div>
					
                        <div class="input-field">
                            <label>Email</label>
                            <input type="email" placeholder="Enter your email" name="email" value="{{ $user->email }}" required>
                        </div>

	
						<br><br><br>
						<button  type="submit" class="saveBtn">
                        <span class="btnText">Save</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                        
                    </div>
               </form>
                </div>
				<form action="{{ route('changepassword') }}" method="POST">
				@csrf
                <div class="details ID">
                    <span class="title">Change Password</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Old Password</label>
                            <input type="password" placeholder="Enter your old password" name="current_password" required>
                        </div>
                        <div class="input-field">
                            <label>New Password</label>
                            <input type="password" placeholder="Enter your new password" name="password" required>
                        </div>
						<div class="input-field">
                            <label>Confirm New Password</label>
                            <input type="password" placeholder="Confirm your new password" name="password_confirmation" required>
                        </div>
						<button type="submit" class="sumbit">
						<span class="btnText">Save</span>
						<i class="uil uil-navigator"></i>
					</button>
                   
                    </div>
					
					
                    
                </div> 
            </div>