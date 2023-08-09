document.addEventListener("DOMContentLoaded", function(event) {


  //selecting material type icons and displaying material accordingly
  document.querySelectorAll(".materialType i").forEach(function(icon) {
      icon.addEventListener("click", function() {
            // Remove the 'selected' class from all icons
            document.querySelectorAll(".materialType i").forEach(function(icon) {
                icon.classList.remove("selected");
            });

            // Add the 'selected' class to the clicked icon
            icon.classList.add("selected");
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

          //DOWNLOAD BUTTON

          // Create a cell for the download link
          var downloadCell = row.insertCell();
          // Create an <a> tag
          var downloadLink = document.createElement("a");
          downloadLink.href = "/download-material/" + material.id; // Update the href to use the material ID
          downloadLink.className = "download-link";
          downloadLink.title = "Download";
          // Create the download button icon using FontAwesome classes
          var downloadIcon = document.createElement("i");
          downloadIcon.className = "bx bx-download"; // Use the FontAwesome download icon class

          // Append the icon to the <a> tag
          downloadLink.appendChild(downloadIcon);

          // Append the <a> tag to the cell
          downloadCell.appendChild(downloadLink);


          //EDIT BUTTON

          // Create a cell for the edit button
          var editCell = row.insertCell();

          // Create the edit button icon using FontAwesome classes
          var editIcon = document.createElement("i");
          editIcon.className = "bx bx-edit";

          // Create the edit button as a link with an icon
          var editButton = document.createElement("a");
          editButton.title = "Edit";
          editButton.className = "edit-btn";
          editButton.setAttribute("data-toggle", "modal");
          editButton.setAttribute("data-bs-target", "#editMaterialModal");
          editButton.appendChild(editIcon);

          // Add event listener for opening the edit modal
          editButton.addEventListener("click", function() {
              openEditModal(material); // Pass the material details to the function
          });

          // Append the button to the cell
          editCell.appendChild(editButton);



          //DELETE BUTTON

          // Create a cell for the delete button
          var deleteCell = row.insertCell();

          // Create the delete button icon using FontAwesome classes
          var deleteIcon = document.createElement("i");
          deleteIcon.className = "bx bx-trash"; // Use the FontAwesome trash icon class

          // Create the delete button as a link with an icon
          var deleteButton = document.createElement("a");
          deleteButton.title = "Delete";
          deleteButton.className = "delete-btn"; // Use a danger class for delete actions
          deleteButton.addEventListener("click", function() {
              // Display a confirmation dialog before proceeding with deletion
              var confirmation = confirm("Do you want to delete this?");
              if (confirmation) {
                  window.location.href = deleteLink.href; // Proceed with deletion
              }
          });
          deleteButton.appendChild(deleteIcon);

          // Append the button to the cell
          deleteCell.appendChild(deleteButton);



      });
  }

  // Function to open the edit modal and populate form fields
  function openEditModal(material) {
      var titleField = document.getElementById("materialTitle");
      var typeField = document.getElementById("materialType");
      var materialIdField = document.getElementById("materialId"); 

      titleField.value = material.title;
      materialIdField.value = material.id;
      typeField.value = material.material_type;
      console.log(material.id);

      var myModal = new bootstrap.Modal(document.getElementById('editMaterialModal'));
      myModal.show();
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

              //displaying students enrolled in course
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
                  .catch(error => console.error('Error fetching data:', error));

                  document.querySelectorAll(".materialType i").forEach(function(icon) {
                    icon.classList.remove("selected");
                });
                
                // Find the presentation icon and add the 'selected' class
                var presentationIcon = document.querySelector(".materialType i[title='Presentation']");
                presentationIcon.classList.add("selected");

                  //get couse material of selected course
                  var xhr = new XMLHttpRequest();
                  xhr.open("GET", "/get-course-materials/" + courseId + "/" + "Presentation", true);
                  xhr.onreadystatechange = function() {
                      if (xhr.readyState === 4 && xhr.status === 200) {
                          var courseMaterials = JSON.parse(xhr.responseText);
                          displayCourseMaterials(courseMaterials);
                      }
                  };
                  xhr.send();

                  //get submissions of selected course
                  fetch(`/get-submissions/${courseId}`)
                  .then(response => response.json())
                  .then(data => {
                      const submissionTable = document.getElementById('course-sub');
                      submissionTable.innerHTML = '';

                      data.submissions.forEach(submission => {
                          const row = document.createElement('tr');
                          row.innerHTML = `
                                  <td>${submission.id}</td>
                                  <td>${submission.title}</td>
                                  <td>${submission.upload_date}</td>
                                  <td>${submission.student_id}</td>
                                  <td>${submission.link_id}</td>
                                  <td>${submission.total_marks}</td>
                                  <td>${submission.grade}</td>
                                  <td>${submission.feedback}</td>
                                  <td><a href="/download-material/${submission.id}" download><i class="bx bx-download"></i></a></td>

                                  <td><a href="" class="comment-icon" data-submission-id="${submission.id}"><i class="bx bx-comment-add"></i></a></td>
                                  
                              `;
                              submissionTable.appendChild(row);
                      });

                      // Attach event listeners to comment icons
                      const commentIcons = document.querySelectorAll('.comment-icon');
                      commentIcons.forEach(icon => {
                          icon.addEventListener('click', openCommentModal);
                      });

                  })
                  .catch(error => console.error('Error fetching data:', error));


                  function openCommentModal(event) {
                    event.preventDefault();
                
                    const submissionId = event.currentTarget.getAttribute('data-submission-id');
                    const modal = document.getElementById('commentModal');
                    const form = document.getElementById('commentForm');
                    const saveBtn = document.getElementById('markSub');
                    
                    const commentTextarea = form.querySelector('#comment');

                    const closeModalButton = document.getElementById('closeModal');


                    closeModalButton.addEventListener('click', () => {
                      commentModal.style.display = 'none';
                    });
                
                    fetch(`/get-submissions-details/${submissionId}`)
                  .then(response => response.json())
                  .then(data => {
                    const inputid = document.getElementById('id');
                     const inputmarks = document.getElementById('marks');
                     const inputgrade = document.getElementById('grade');
                     const inputfeedback = document.getElementById('feedback');

                      data.submission_details.forEach(submission_detail => {
                        inputid.value = submission_detail.id;
                         inputmarks.value = submission_detail.total_marks;
                         inputgrade.value = submission_detail.grade;
                         inputfeedback.value = submission_detail.feedback;
                      });

                      //display grade accoring to makrs
                      inputmarks.onkeyup = function() {
                        if (inputmarks.value >= 80) {
                            inputgrade.value = "A";
                        } else if (inputmarks.value >= 70 && inputmarks.value < 80) {
                            inputgrade.value = "B";
                        } else if (inputmarks.value >= 60 && inputmarks.value < 70) {
                          inputgrade.value = "C";
                        } else if (inputmarks.value >= 50 && inputmarks.value < 60) {
                          inputgrade.value = "D";
                        }else if (inputmarks.value >= 40 && inputmarks.value < 50) {
                          inputgrade.value = "E";
                        } else {
                            inputgrade.value = "F"; 
                        }
                    };

                  })
                
                    // Display the modal
                    modal.style.display = 'block';

                    
                  
                }
                

          }
      });
  });

  // course dropdown
  const courseDropdown = document.getElementById('course');

  courseDropdown.addEventListener('change', function() {

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

  const showNavbar = (toggleId, navId, bodyId, headerId) => {
      const toggle = document.getElementById(toggleId),
          nav = document.getElementById(navId),
          bodypd = document.getElementById(bodyId),
          headerpd = document.getElementById(headerId)

      // Validate that all variables exist
      if (toggle && nav && bodypd && headerpd) {
          toggle.addEventListener('click', () => {
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

  showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

  /*===== LINK ACTIVE =====*/
  const linkColor = document.querySelectorAll('.nav_link')

  function colorLink() {
      if (linkColor) {
          linkColor.forEach(l => l.classList.remove('active'))
          this.classList.add('active')
      }
  }
  linkColor.forEach(l => l.addEventListener('click', colorLink))


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

  confirmPasswordInput.onkeyup = function() {
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
      if (myInput.value.match(lowerCaseLetters)) {
          letter.classList.remove("invalid");
          letter.classList.add("valid");
      } else {
          letter.classList.remove("valid");
          letter.classList.add("invalid");
      }

      // Validate capital letters
      var upperCaseLetters = /[A-Z]/g;
      if (myInput.value.match(upperCaseLetters)) {
          capital.classList.remove("invalid");
          capital.classList.add("valid");
      } else {
          capital.classList.remove("valid");
          capital.classList.add("invalid");
      }

      // Validate numbers
      var numbers = /[0-9]/g;
      if (myInput.value.match(numbers)) {
          number.classList.remove("invalid");
          number.classList.add("valid");
      } else {
          number.classList.remove("valid");
          number.classList.add("invalid");
      }




      // Validate length
      if (myInput.value.length >= 8) {
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