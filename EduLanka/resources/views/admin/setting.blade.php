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
<<<<<<< HEAD
            </div>
            <div class="form second">
                <div class="details address">
                    <span class="title">Address Details</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Address Type</label>
                            <input type="text" placeholder="Permanent or Temporary" required>
                        </div>
                        <div class="input-field">
                            <label>Nationality</label>
                            <input type="text" placeholder="Enter nationality" required>
                        </div>
                        <div class="input-field">
                            <label>State</label>
                            <input type="text" placeholder="Enter your state" required>
                        </div>
                        <div class="input-field">
                            <label>District</label>
                            <input type="text" placeholder="Enter your district" required>
                        </div>
                        <div class="input-field">
                            <label>Block Number</label>
                            <input type="number" placeholder="Enter block number" required>
                        </div>
                        <div class="input-field">
                            <label>Ward Number</label>
                            <input type="number" placeholder="Enter ward number" required>
                        </div>
                    </div>
                </div>
                <div class="details family">
                    <span class="title">Family Details</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Father Name</label>
                            <input type="text" placeholder="Enter father name" required>
                        </div>
                        <div class="input-field">
                            <label>Mother Name</label>
                            <input type="text" placeholder="Enter mother name" required>
                        </div>
                        <div class="input-field">
                            <label>Grandfather</label>
                            <input type="text" placeholder="Enter grandfther name" required>
                        </div>
                        <div class="input-field">
                            <label>Spouse Name</label>
                            <input type="text" placeholder="Enter spouse name" required>
                        </div>
                        <div class="input-field">
                            <label>Father in Law</label>
                            <input type="text" placeholder="Father in law name" required>
                        </div>
                        <div class="input-field">
                            <label>Mother in Law</label>
                            <input type="text" placeholder="Mother in law name" required>
                        </div>
                    </div>
                    <div class="buttons">
                        <div class="backBtn">
                            <i class="uil uil-navigator"></i>
                            <span class="btnText">Back</span>
                        </div>
                        
                        <button class="sumbit">
                            <span class="btnText">Submit</span>
                            <i class="uil uil-navigator"></i>
                        </button>
                    </div>
                </div> 
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
</body>
</html>
=======
            </div>
>>>>>>> 235b672541997a1870d1742ede30cfdd88bfdac2
