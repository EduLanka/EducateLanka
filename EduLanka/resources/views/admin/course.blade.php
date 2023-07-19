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
			<li class="active">
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
			<li>
				<a href="{{url('/teachers')}}">
					<i class='bx bxs-user' ></i>
					<span class="text">Teacher</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-user-circle' ></i>
					<span class="text">admin</span>
				</a>
			</li>
            <li>
				<a href="#">
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
			<a href="#" class="nav-link">Categories</a>
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
							<a href="">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="{{url('admin')}}">Home</a>
						</li>
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="{{url('/course')}}">Course</a>
						</li>
					</ul>
				</div>
				
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Courses</h3>
						<!-- Button trigger modal pop up -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Add Course
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Course</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	<!--  form start -->
      <div class="modal-body">
        <form action="{{url('uploadcourse')}}" method="POST" enctype="multipart/from-data">
			@csrf
          <div class="mb-3">
		  <label for="recipient-name" class="col-form-label">Level:</label>
         <select class="form-control" id="recipient-name" name="level" required>
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
		  <label for="exampleFormControlInput1" class="form-label">Subject:</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Biological Science" name="subject" required>
          </div>

		  <button type="submit" class="btn btn-primary">Save</button>

        </form>
      </div>
	  <!-- end form start -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
					</div>
                    
					<table>
						<thead>
							<tr>
								<th>User</th>
								<th>Date Order</th>
								<th>Action</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach ($data as $data)
							<tr id="row{{ $data->id }}" >
								<td>
									
									<p>{{ $data->level }}</p>
								</td>
								<td>{{ $data->subject }}</td>
								<i  class="bx bx-pencil bounce-icon" style="color: #449e3d; font-size: 24px;" onclick="openEditModal({{ $data->id }})"></i>
							 </td>
								<td><a href="{{url('/deletecourse',$data->id)}}"> <i class="bx bx-trash bounce-icon" style="color: #FF0000; font-size: 24px;" ></i></a></td>
								

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




	<!-- first onclick to edit button
	second Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="{{ route('update') }}" method="POST">
                    @csrf
                    <input type="hidden" id="editItemId" name="itemId" value="">
                    <!-- Add form fields for editing item properties -->
                    <div class="form-group">
                        <label for="editLevel">Level</label>
                        <input type="text" class="form-control" id="editLevel" name="level">
                    </div>
                    <div class="form-group">
                        <label for="editSubject">Subject</label>
                        <input type="text" class="form-control" id="editSubject" name="subject">
                    </div>
                    <!-- Add more form fields as needed -->

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
	




<!--js to modal to be open-->
<script>
    function openEditModal(itemId) {
        var itemRow = document.getElementById('row' + itemId);
        var itemLevel = itemRow.querySelector('p').textContent;
        var itemSubject = itemRow.querySelector('td:nth-child(2)').textContent;

        document.getElementById('editItemId').value = itemId;
        document.getElementById('editLevel').value = itemLevel;
        document.getElementById('editSubject').value = itemSubject;

        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
    }
</script>



	<script src="assets/script.js"></script>
</body>
</html>