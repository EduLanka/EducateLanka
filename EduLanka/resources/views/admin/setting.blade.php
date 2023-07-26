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
                            <input type="password" id="psw" placeholder="Enter your new password" name="password" required>
                        </div>
                        <div id="criteria">
                        New password must contain the following:
                        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                        <p id="number" class="invalid">A <b>number</b></p>
                        <p id="specialChar" class="invalid">A <b>special character</b></p>
                        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                      </div>
						<div class="input-field">
                            <label>Confirm New Password</label>
                            <input type="password" id="confirmPassword" placeholder="Confirm your new password" name="password_confirmation" required>
                            <p id="confirmErrorMessage" style="color: red; display: none;">Passwords do not match</p>
                        </div>
						<button type="submit" class="sumbit">
						<span class="btnText">Save</span>
						<i class="uil uil-navigator"></i>
					</button>
                    <button type="submit" class="sumbit"> <a href="{{url('admin')}}" style= "text-decoration: none; color: white;">
						<span >Cancel</span>
						</a>
					</button>
                   
                    </div>
					
					
                    
                </div> 
            </div>
       

            <script>
                var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");


// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("criteria").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("criteria").style.display = "none";
}

//confirm password not matching new password error
var confirmPasswordInput = document.getElementById("confirmPassword");
var confirmErrorMessage = document.getElementById("confirmErrorMessage");

confirmPasswordInput.onkeyup = function () {
  if (confirmPasswordInput.value !== myInput.value) {
    confirmErrorMessage.style.display = "block";
  } else {
    confirmErrorMessage.style.display = "none";
  }
};


// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  
  
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }

  var specialCharacters = /[-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/@#]/g;
  if (myInput.value.match(specialCharacters)) {  
    specialChar.classList.remove("invalid");
    specialChar.classList.add("valid");
  } else {
    specialChar.classList.remove("valid");
    specialChar.classList.add("invalid");
  }
  
 
}
            </script>
</body>
</html>
</body>
</html>
