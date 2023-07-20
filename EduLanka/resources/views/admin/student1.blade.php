<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- My CSS -->
	<link rel="stylesheet" href="assets/admin.css">
    <!-- end if link to CSS -->
    <!-- link to jquery file for logout-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- end link to jquery file for logout-->

    <!-- js file for logout-->
    <script>
        $(document).ready(function() {
            $('.logout').click(function(e) {
                e.preventDefault();
                $('#logout-form').submit();
            });
        });
    </script>
     <!-- js file for logout-->

	<title>Admin Dashborad</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a  class="brand">
			<img src="assets/images/Logo.jpg" alt="" style=" height:80px; min-width: 90px; display: flex; justify-content: center; ">
			<span class="text"  style=" padding:10px; ">EduLanka</span>
		</a>
		<ul class="side-menu top">
			<li >
				<a href="{{url('admin')}}">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li >
				<a href="{{url('/course')}}">
					<i class='bx bx-book' ></i>
					<span class="text">Course</span>
				</a>
			</li>
			<li class="active">
				<a href="{{url('/students')}}">
					<i class='bx bx-group' ></i>
					<span class="text">Students</span>
				</a>
			</li>
			<li>
				<a href="{{url('/teachers')}}">
					<i class='bx bxs-user' ></i>
					<span class="text">Teacher</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-user-circle' ></i>
					<span class="text">Advert</span>
				</a>
			</li>
            <li>
				<a href="{{url('/dev')}}">
					<i class='bx bx-code-alt' ></i>
					<span class="text">Developer</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li class="nav-item">
        <a href="#" class="nav-link logout">
            <i class='bx bxs-log-out-circle'></i>
            <span class="text">Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
		</ul>
	</section>
	<!--end SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="" class="nav-link">Students</a>
			<form action="">
				
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="" class="profile">
            {{ Auth::user()->name }}
			</a>
		</nav>
		<!-- end of NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="{{url('admin')}}">Home</a>
						</li>
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="{{url('/students')}}">Student</a>
						</li>
					</ul>
				</div>
				
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Students</h3>

                        <form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
                    
						<!-- Button trigger modal pop up -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Register Student
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <form method="POST" action="{{ url('createStudent') }}" enctype="multipart/form-data">
		@csrf
      <div class="modal-body">
        <!--form start -->
		<div class="mb-3">
			<label for="fname" class="form-label">First Name</label>
			<input type="text" class="form-control" name = "fname" id="exampleFormControlInput1" placeholder="Maryam">
		</div>
		<div class="mb-3">
			<label for="lname" class="form-label">Last Name</label>
			<input type="text" class="form-control" name = "lname" id="exampleFormControlInput1" placeholder="Mashkoora">
		</div>
		<div class="mb-3">
			<label for="email" class="form-label">Email address</label>
			<input type="text" class="form-control" name = "email" id="exampleFormControlInput1" placeholder="name@example.com">
		</div>
		<div class="mb-3">
			<label for="bday" class="form-label">Birthday</label>
			<input type="date" class="form-control" name = "bday" id="exampleFormControlInput1" placeholder="name@example.com">
		</div>
		<div class="mb-3">
			<label for="level" class="form-label">Level</label>
			<input type="text" class="form-control" name = "level" id="exampleFormControlInput1" placeholder="A-level">
		</div>
		<div class="mb-3">
			<label for="school" class="form-label">School</label>
			<input type="text" class="form-control" name = "school" id="exampleFormControlInput1" placeholder="Example school">
		</div>
		<div class="mb-3">
			<label for="guardian" class="form-label">Guardian Name</label>
			<input type="text" class="form-control" name="guardian" id="exampleFormControlInput1" placeholder="">
		</div>
		

                <!-- end of form -->

      </div>
	
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

	  </form>
    </div>
  </div>
</div>
					</div>
                    
					<table>
						<thead>
							<tr>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
								<th>Birthday</th>
								<th>Level</th>
								<th>School</th>
								<th>Guardian Name</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($students as $student)
                  		<tr id="row{{ $student->id }}">
							<td>{{$student -> first_name}} </td>
							<td>{{$student -> last_name}}</td>
							<td>{{$student -> email}}</td>
							<td>{{$student -> birthday}}</td>
							<td>{{$student -> level}}</td>
							<td>{{$student -> school}}</td>
							<td>{{$student -> guardian_id}}</td>
							<td> 
							<td> 
							<i  class="bx bx-pencil bounce-icon" style="color: #449e3d; font-size: 24px;" onclick="openEditModal({{ $student->id }})"></i>
							 </td>
							<td><a href="{{url('/deleteStudent',$student->id)}}"><i class="bx bx-trash bounce-icon" style="color: #FF0000; font-size: 24px;" onclick="confirmDelete(event)"></i></a></td>
							<!--<td><span class="status completed">Completed</span></td>    -->             
                  		</tr>
                  @endforeach
						</tbody>
					</table>
				</div>

          		

			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="{{ route('updatestu') }}" method="POST">
                    @csrf
                    <input type="hidden" id="editStudentId" name="studentId" value="">
                    <!-- Add form fields for editing student properties -->
                    <div class="form-group">
                        <label for="editFirstName">First Name</label>
                        <input type="text" class="form-control" id="editFirstName" name="first_name">
                    </div>
                    <div class="form-group">
                        <label for="editLastName">Last Name</label>
                        <input type="text" class="form-control" id="editLastName" name="last_name">
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="editBirthday">Birthday</label>
                        <input type="date" class="form-control" id="editBirthday" name="birthday">
                    </div>
                    <div class="form-group">
                        <label for="editLevel">Level</label>
                        <input type="text" class="form-control" id="editLevel" name="level">
                    </div>
                    <div class="form-group">
                        <label for="editSchool">School</label>
                        <input type="text" class="form-control" id="editSchool" name="school">
                    </div>
                    <div class="form-group">
                        <label for="editGuardianId">Guardian ID</label>
                        <input type="text" class="form-control" id="editGuardianId" name="guardian_id">
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


	
<script>
    function openEditModal(studentId) {
        var studentRow = document.getElementById('row' + studentId);
        var studentFirstName = studentRow.querySelector('td:nth-child(1)').textContent;
        var studentLastName = studentRow.querySelector('td:nth-child(2)').textContent;
        var studentEmail = studentRow.querySelector('td:nth-child(3)').textContent;
        var studentBirthday = studentRow.querySelector('td:nth-child(4)').textContent;
        var studentLevel = studentRow.querySelector('td:nth-child(5)').textContent;
        var studentSchool = studentRow.querySelector('td:nth-child(6)').textContent;
        var studentGuardianId = studentRow.querySelector('td:nth-child(7)').textContent;

        document.getElementById('editStudentId').value = studentId;
        document.getElementById('editFirstName').value = studentFirstName;
        document.getElementById('editLastName').value = studentLastName;
        document.getElementById('editEmail').value = studentEmail;
        document.getElementById('editBirthday').value = studentBirthday;
        document.getElementById('editLevel').value = studentLevel;
        document.getElementById('editSchool').value = studentSchool;
        document.getElementById('editGuardianId').value = studentGuardianId;

        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
    }
</script>

<script>
	//confirmation dialog for delete
	function confirmDelete(event) {
    event.preventDefault(); 

    // Show the alert dialog
    if (confirm("Are you sure you want to delete this teacher?")) {
      // If the user clicks OK, proceed with the deletion 
      window.location.href = event.target.parentElement.href;
    }
  }
</script>






	<script src="assets/script.js"></script>
</body>
</html>