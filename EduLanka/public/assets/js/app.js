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
            deleteButton.className = "delete-btn"; 
  
            deleteButton.href = "/delete-material/" + material.id;
  
            deleteButton.addEventListener("click", function() {
                // Display a confirmation dialog before proceeding with deletion
                var confirmation = confirm("Do you want to delete this?");
                if (confirmation) {
                    window.location.href = deleteLink.href; // Proceed with deletion
                  } else {
                  console.log("Deletion was canceled.");
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
                                    <td><a href="" class="contact-icon" data-student-id="${student.id}" data-guardian-id="${student.guardian_id}"><i class="bx bx-message-square-detail"></i></a></td>  
                                `;
                            participantTable.appendChild(row);
                        });  


                        const contactIcons = document.querySelectorAll('.contact-icon');
                        contactIcons.forEach(icon => {
                            icon.addEventListener('click', openContactModal);
                        });

                    })
                    .catch(error => console.error('Error fetching data:', error));
  
                    
                    document.querySelectorAll(".materialType i").forEach(function(icon) {
                      icon.classList.remove("selected");
                  });

                 
                    const studentBtn = document.getElementById('contact-s');
                    studentBtn.addEventListener('click', function() {
                        const studentId = studentBtn.getAttribute('data-student-id');
                        if (studentId !== null && studentId !== "") {
                            window.location.href = `/chatify/${studentId}`;
                        }
                    });

                    const parentBtn = document.getElementById('contact-p');
                    parentBtn.addEventListener('click', function() {
                        const guardianId = parentBtn.getAttribute('data-guardian-id');
                        if (guardianId !== null && guardianId !== "") {
                            window.location.href = `/chatify/${guardianId}`;
                        }
                    });
  
                    function openContactModal(event) {
                        event.preventDefault();

                        const studentId = event.currentTarget.getAttribute('data-student-id');
                        const guardianId = event.currentTarget.getAttribute('data-guardian-id');
                        console.log('Student ID:', studentId);
                        console.log('guradian ID:', guardianId);
                        
                        const modal = document.getElementById('contactModal');
                        const closeModalButton = document.getElementById('closeModal1');
                    
                        studentBtn.setAttribute('data-student-id', studentId); 
                        parentBtn.setAttribute('data-guardian-id', guardianId); 
                    
                        closeModalButton.addEventListener('click', () => {
                            modal.style.display = 'none';
                        });

                        modal.style.display = 'block';
                    }
                                    
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
                                    <td>${submission.total_marks !== null ? submission.total_marks : 'N/A'}</td>
                                    <td>${submission.grade !== null ? submission.grade : 'N/A'}</td>
                                    <td>${submission.feedback !== null ? submission.feedback : 'N/A'}</td>
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
    const courseDropdown = document.getElementById('courseDropdown');
  
    courseDropdown.addEventListener('change', function() {
      const selectedCourseId = courseDropdown.value;
      console.log(selectedCourseId);
  
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
                  <td>${student.submission_count}</td>
                  <td>${student.average_score !== null ? student.average_score.toFixed(2) : 'N/A'}</td>
              `;
                  studentTableBody.appendChild(row);
              });
          })
          .catch(error => console.error('Error fetching student data:', error));
  
    });
  
  
  
  
  });
  
  
  