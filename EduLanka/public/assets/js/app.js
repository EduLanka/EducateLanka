document.addEventListener("DOMContentLoaded", function(event) {

  //selecting material type icons and displaying material accordingly
  document.querySelectorAll(".materialType i").forEach(function(icon) {
    icon.addEventListener("click", function() {
        var materialType = icon.getAttribute("title"); // Get the material type from the icon title
        var courseId = document.querySelector('input[name="selected_course"]:checked').value;
        console.log(courseId); // Get the selected course ID
        
        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/get-course-materials/" + courseId + "/" + materialType, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var courseMaterials = JSON.parse(xhr.responseText);
                displayCourseMaterials(courseMaterials);
            }
        };
        xhr.send();
    });
});

function displayCourseMaterials(courseMaterials) {
  var courseMatTable = document.getElementById("course-mat");
  courseMatTable.innerHTML = ""; // Clear the previous content
  
  courseMaterials.forEach(function(material) {
      var row = courseMatTable.insertRow();
      row.insertCell().textContent = material.material_type;
      row.insertCell().textContent = material.id;
      row.insertCell().textContent = material.title;
      row.insertCell().textContent = material.uploadDate;
  });
}

//selecting course

  const radioButtons = document.querySelectorAll('input[type="radio"][name="selected_course"]');

        radioButtons.forEach(radioButton => {
            radioButton.addEventListener('change', function() {
                if (this.checked) {
                    const courseName = this.getAttribute('data-course-name');
                    console.log('Selected course:', courseName);
                    var courseMatTable = document.getElementById("course-mat");
                    courseMatTable.innerHTML = "";

                    const courseId = this.value;
                    fetch(`/get-students/${courseId}`)
                        .then(response => response.json())
                        .then(data => {
                            const participantTable = document.getElementById('course-parti');
                            participantTable.innerHTML = '';

                            data.students.forEach(student => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${student.id}</td>
                                    <td>${student.first_name} ${student.last_name}</td>   
                                `;
                                participantTable.appendChild(row);
                            });
                        })
                        .catch(error => console.error('Error fetching student data:', error));




                    
                    }
            });
        });

  // course dropdown
  const courseDropdown = document.getElementById('course');
    
  courseDropdown.addEventListener('change', function () {
  
      const selectedCourseId = courseDropdown.value;
      
      console.log('Sending AJAX request for course:', selectedCourseId);

      // Send AJAX request
      fetch(`/get-students/${selectedCourseId}`)
          .then(response => response.json())
          .then(data => {
              const studentTableBody = document.getElementById('student-table-body');
              studentTableBody.innerHTML = ''; // Clear existing rows
              
              data.students.forEach(student => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${student.first_name}</td>
                    <td>${student.id}</td>
                    <td>${student.average_score !== null ? student.average_score.toFixed(2) : 'N/A'}</td>
                `;
                studentTableBody.appendChild(row);
            });
          })
          .catch(error => console.error('Error fetching student data:', error));
  });



   
  //navbar javascript
  
  const showNavbar = (toggleId, navId, bodyId, headerId) =>{
  const toggle = document.getElementById(toggleId),
  nav = document.getElementById(navId),
  bodypd = document.getElementById(bodyId),
  headerpd = document.getElementById(headerId)
  
  // Validate that all variables exist
  if(toggle && nav && bodypd && headerpd){
  toggle.addEventListener('click', ()=>{
  // show navbar
  nav.classList.toggle('show')
  // change icon
  toggle.classList.toggle('bx-x')
  // add padding to body
  bodypd.classList.toggle('body-pd')
  // add padding to header
  headerpd.classList.toggle('body-pd')
  })
  }
  }
  
  showNavbar('header-toggle','nav-bar','body-pd','header')
  
  /*===== LINK ACTIVE =====*/
  const linkColor = document.querySelectorAll('.nav_link')
  
  function colorLink(){
  if(linkColor){
  linkColor.forEach(l=> l.classList.remove('active'))
  this.classList.add('active')
  }
  }
  linkColor.forEach(l=> l.addEventListener('click', colorLink))


  //displaying the students enrolled in each course

 
  

    //for password validation
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
  // console.log("passwordddd");
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


  });