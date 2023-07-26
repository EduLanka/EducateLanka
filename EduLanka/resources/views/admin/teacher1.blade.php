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
			<li>
				<a href="{{url('/students')}}">
					<i class='bx bx-group' ></i>
					<span class="text">Students</span>
				</a>
			</li>
			<li class="active" >
				<a href="{{url('/teachers')}}">
					<i class='bx bxs-user' ></i>
					<span class="text">Teacher</span>
				</a>
			</li>
			<li >
				<a href="">
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
				<a href="{{url('/setting')}}">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li class="nav-item">
        <a href="#" class="nav-link logout" onclick="confirmLogout()" >
            <i class='bx bxs-log-out-circle'></i>
            <span class="text">Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" >
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
			<a href="" class="nav-link">Teacher</a>
			<form action="">
				
			</form>
			
			<input type="checkbox" id="" hidden>
			<label for="switch-mode" class=""></label>
			<a href="" class="">
				<i ></i>
				<span class="num"></span>
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
							<a class="active" href="{{url('/teachers')}}">Teacher</a>
						</li>
					</ul>
				</div>
				
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Teachers</h3>

                        <form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
                    
						<!-- Button trigger modal pop up -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Register Teacher
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Teacher</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <form method="POST" action="{{ url('createTeacher') }}" enctype="multipart/form-data">
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
			<label for="level" class="form-label">Level</label>
			<select class="form-control" id="exampleFormControlInput1" name="level" placeholder="A-level" required>
  <option value="grade5">Grade 5</option>
  <option value="grade6">Grade 6</option>
  <option value="grade7">Grade 7</option>
  <option value="grade8">Grade 8</option>
  <option value="grade9">Grade 9</option>
  <option value="grade10">Grade 10</option>
  <option value="grade11">Grade 11</option>
  <option value="grade12">Grade 12</option>
  <option value="grade13">Grade 13</option>
  <!-- Add more options as needed -->
</select>
		</div>
		<div class="mb-3">
			<label for="school" class="form-label">School</label>
			<input type="text" class="form-control" name = "school" id="exampleFormControlInput1" placeholder="Example school">
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
								<th>Level</th>
								<th>School</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($teachers as $teacher)
                  		<tr  id="row{{ $teacher->id }}">
							<td>{{$teacher -> first_name}}</td>
							<td>{{$teacher -> last_name}}</td>
							<td>{{$teacher -> email}}</td>
							<td>{{$teacher -> level}}</td>
							<td>{{$teacher -> school}}</td>
							<td>	<i onclick="openEditModal({{ $teacher->id }})" class="bx bx-pencil bounce-icon" style="color: #449e3d; font-size: 24px;"></i></td>
							<td><a href="{{url('/deleteTeacher',$teacher->id)}}"><i class="bx bx-trash bounce-icon" style="color: #FF0000; font-size: 24px;" onclick="confirmDelete(event)" ></i></a></td>           
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



	<!-- Bootstrap modal -->
<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="edit-modal-label">Edit Teacher Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<!-- Edit form -->
				<form id="editForm" action="{{ route('updatetech') }}" method="POST">
					@csrf
					<input type="hidden" name="teacher_id" id="teacher_id">
					<div class="form-group">
						<label for="first_name">First Name:</label>
						<input type="text" class="form-control" name="first_name" id="first_name">
					</div>
					<div class="form-group">
						<label for="last_name">Last Name:</label>
						<input type="text" class="form-control" name="last_name" id="last_name">
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" class="form-control" name="email" id="email">
					</div>
					<div class="form-group">
						<label for="level">Level:</label>
						<select class="form-control" id="level" name="level">
  <option value="grade5">Grade 5</option>
  <option value="grade6">Grade 6</option>
  <option value="grade7">Grade 7</option>
  <option value="grade8">Grade 8</option>
  <option value="grade9">Grade 9</option>
  <option value="grade10">Grade 10</option>
  <option value="grade11">Grade 11</option>
  <option value="grade12">Grade 12</option>
  <option value="grade13">Grade 13</option>
  <!-- Add more options as needed -->
</select>
					</div>
					<div class="form-group">
						<label for="school">School:</label>
						<input type="text" class="form-control" name="school" id="school">
					</div>
					<button type="submit" class="btn btn-primary">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>




<footer>

<marquee direction="right" scrollamount="14"> <span class="tab">The Best Learning platform</span>  	Copyright &copy; <script>document.write(new Date().getFullYear())</script> Edu Lanka  All Right Reseved <span class="tab1">The Best Learning platform</span> </marquee>

	
</footer>

<script>
function confirmLogout() {
    if (window.confirm('Are you sure you want to logout?')) {
        document.getElementById('logout-form').submit();
    }
}
</script>



<script>
	function openEditModal(teacherId) {
    var teacherRow = document.getElementById('row' + teacherId);
    var teacherFirstName = teacherRow.querySelector('td:nth-child(1)').textContent;
    var teacherLastName = teacherRow.querySelector('td:nth-child(2)').textContent;
    var teacherEmail = teacherRow.querySelector('td:nth-child(3)').textContent;
    var teacherLevel = teacherRow.querySelector('td:nth-child(4)').textContent;
    var teacherSchool = teacherRow.querySelector('td:nth-child(5)').textContent;

    document.getElementById('teacher_id').value = teacherId;
    document.getElementById('first_name').value = teacherFirstName;
    document.getElementById('last_name').value = teacherLastName;
    document.getElementById('email').value = teacherEmail;
    document.getElementById('level').value = teacherLevel;
    document.getElementById('school').value = teacherSchool;

    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}

</script>



<script>
  // Confirmation dialog for delete
  function confirmDelete(event) {
    event.preventDefault();

    // Show the alert dialog
    if (confirm("Are you sure you want to delete this courser?")) {
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
</script>
@if(Session::has('email_exists_error'))
    <script>
        // Display the pop-up message using JavaScript (you can use any pop-up library or implement your custom solution)
        alert("{{ Session::get('email_exists_error') }}");
    </script>
@endif
@if(Session::has('teacher_added_success'))
    <script>
        alert("{{ Session::get('teacher_added_success') }}");
    </script>
@endif
@if(Session::has('teacher_edit_success'))
    <script>
        alert("{{ Session::get('teacher_edit_success') }}");
    </script>
@endif



	<script src="assets/script.js"></script>
</body>
</html>