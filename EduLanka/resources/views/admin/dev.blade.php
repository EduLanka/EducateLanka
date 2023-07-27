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
					<span class="text">Courses</span>
				</a>
			</li>
			<li>
				<a href="{{url('/students')}}">
					<i class='bx bx-group' ></i>
					<span class="text">Students</span>
				</a>
			</li>
			<li  >
				<a href="{{url('/teachers')}}">
					<i class='bx bxs-user' ></i>
					<span class="text">Teachers</span>
				</a>
			</li>
			<li >
				<a href="{{url('/banner')}}">
					<i class='bx bxs-user-circle' ></i>
					<span class="text">Announcments</span>
				</a>
			</li>
            <li class="active">
				<a href="{{url('/dev')}}">
					<i class='bx bx-code-alt' ></i>
					<span class="text">Developers</span>
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
        <a href="#" class="nav-link logout" onclick="confirmLogout()">
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
			<a href="" class="nav-link">Developers</a>
			<form action="">
				
			</form>
			<input type="checkbox" id="" hidden>
			<label for="switch-mode" class=""></label>
			<a href="#" class="">
				<i ></i>
				<span class="num"></span>
			
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
							<a class="active" href="{{url('/dev')}}">Developers</a>
						</li>
					</ul>
				</div>
				
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Developers</h3>

                        <form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
                    
						<!-- Button trigger modal pop up -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Register Developer
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Developer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <form method="POST" action="{{ url('adddev') }}" enctype="multipart/form-data">
		@csrf
      <div class="modal-body">
        <!--form start -->
		<div class="mb-3">
			<label for="fname" class="form-label">Full Name</label>
			<input type="text" class="form-control" name = "fname" id="exampleFormControlInput1" placeholder="Maryam">
		</div>
		
		<div class="mb-3">
			<label for="email" class="form-label">Email address</label>
			<input type="text" class="form-control" name = "email" id="exampleFormControlInput1" placeholder="name@example.com">
		</div>
		<div class="mb-3">
			<label for="level" class="form-label">Telno</label>
			<input type="text" class="form-control" name = "telno" id="exampleFormControlInput1" placeholder="075122333">
		</div>
		<div class="mb-3">
			<label for="school" class="form-label">Address</label>
			<input type="text" class="form-control" name = "add" id="exampleFormControlInput1" placeholder="Full Address">
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
								<th>Email</th>
								<th>Telno</th>
								<th>Address</th>
								<th></th>
                                <th></th>
							</tr>
						</thead>
						<tbody>
                        @foreach ($dev as $dev)
                  		<tr  id="row{{ $dev->id }}">
							<td>{{$dev -> full_name}}</td>
							<td>{{$dev -> email}}</td>
							<td>{{$dev -> telno}}</td>
							<td>{{$dev -> Address}}</td>
							<td><i  onclick="openEditModal({{ $dev->id }})"  class="bx bx-pencil bounce-icon" style="color: #449e3d; font-size: 24px;"></i></td>
							<td><a href="{{url('/deleteDev',$dev->id)}}"><i class="bx bx-trash bounce-icon" style="color: #FF0000; font-size: 24px;" 
                            onclick="confirmDelete(event)" ></i></a></td>           
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


	
<!-- The Bootstrap modal for editing -->
<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-label">Edit Developer Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <!-- Edit form -->
                <form id="editForm" action="{{ route('updatedev') }}" method="POST">
                    @csrf
                    <input type="hidden" name="dev_id" id="dev_id">
                    <div class="form-group">
                        <label for="full_name">Full Name:</label>
                        <input type="text" class="form-control" name="full_name" id="full_name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="telno">Telno:</label>
                        <input type="text" class="form-control" name="telno" id="telno">
                    </div>
                    <div class="form-group">
                        <label for="Address">Address:</label>
                        <input type="text" class="form-control" name="Address" id="Address">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Bootstrap modal -->
	

	<footer>

	Copyright &copy; <script>document.write(new Date().getFullYear())</script> Edu Lanka  All Right Reseved <span class="tab1">The Best Learning platform</span> 

	
</footer>

<script>
    function openEditModal(devId) {
		
        var developerRow = document.getElementById('row' + devId);
        var developerFullName = developerRow.querySelector('td:nth-child(1)').textContent;
        var developerEmail = developerRow.querySelector('td:nth-child(2)').textContent;
        var developerTelno = developerRow.querySelector('td:nth-child(3)').textContent;
        var developerAddress = developerRow.querySelector('td:nth-child(4)').textContent;

        document.getElementById('dev_id').value = devId;
        document.getElementById('full_name').value = developerFullName;
        document.getElementById('email').value = developerEmail;
        document.getElementById('telno').value = developerTelno;
        document.getElementById('Address').value = developerAddress;

        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
    }
</script>

	
	@if(Session::has('email_exists_error'))
    <script>
        // Display the pop-up message using JavaScript (you can use any pop-up library or implement your custom solution)
        alert("{{ Session::get('email_exists_error') }}");
    </script>
@endif

@if(Session::has('student_added_success'))
    <script>
        alert("{{ Session::get('student_added_success') }}");
    </script>
@endif
@if(Session::has('teacher_edit_success'))
    <script>
        alert("{{ Session::get('teacher_edit_success') }}");
    </script>
@endif

<script>
function confirmLogout() {
    if (window.confirm('Are you sure you want to logout?')) {
        document.getElementById('logout-form').submit();
    }
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
	<script src="assets/script.js"></script>
</body>
</html>