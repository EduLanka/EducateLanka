const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})


//teacher1.blade.php


         function confirmLogout() {
             if (window.confirm('Are you sure you want to logout?')) {
                 document.getElementById('logout-form').submit();
             }
         }

         /*function openEditModal(teacherId) {
             var teacherRow = document.getElementById('row' + teacherId);
             var teacherFirstName = teacherRow.querySelector('td:nth-child(1)').textContent;
             var teacherLastName = teacherRow.querySelector('td:nth-child(2)').textContent;
             var teacherEmail = teacherRow.querySelector('td:nth-child(3)').textContent;
             var teacherNo = teacherRow.querySelector('td:nth-child(4)').textContent;
             var teacherLevel = teacherRow.querySelector('td:nth-child(5)').textContent.split(',');
         
             document.getElementById('teacher_id').value = teacherId;
             document.getElementById('first_name').value = teacherFirstName;
             document.getElementById('last_name').value = teacherLastName;
             document.getElementById('email').value = teacherEmail;
             document.getElementById('no').value = teacherNo;
         
             var levelSelect = document.getElementById('level');
         
             // Reset all options in the level dropdown
             for (var i = 0; i < levelSelect.options.length; i++) {
                 levelSelect.options[i].selected = false;
             }
         
             // Set selected options based on teacherLevel
             for (var i = 0; i < levelSelect.options.length; i++) {
                 if (teacherLevel.includes(levelSelect.options[i].value)) {
                     levelSelect.options[i].selected = true;
                 }
             }
         
             // Add a custom class to the selected options
             $(levelSelect).selectpicker('refresh');
             $(levelSelect).find('.selected').addClass('selected-option');
         
             var editModal = new bootstrap.Modal(document.getElementById('editModal'));
             editModal.show();
         }*/

         // Confirmation dialog for delete
         function confirmDelete(event) {
           event.preventDefault();
         
           // Show the alert dialog
           if (confirm("Are you sure you want to delete this course?")) {
             // If the user clicks OK, proceed with the deletion
             window.location.href = event.target.parentElement.href;
         
             // Display a success message
             showSuccessMessage();
           }
         }
         
         // Function to show the success message
         function showSuccessMessage() {
           // You can customize the success message here
           alert("Deletion was successful!");
         }
      
		 
//end of teacher1.blade.php