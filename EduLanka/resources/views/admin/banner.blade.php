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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

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
			<li>
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
			<li>
				<a href="{{url('/teachers')}}">
					<i class='bx bxs-user' ></i>
					<span class="text">Teachers</span>
				</a>
			</li>
			<li class="active">
				<a href="{{url('/banner')}}">
					<i class='bx bx-image-add' ></i>
					<span class="text">Announcments</span>
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
        <a href="#" class="nav-link logout"onclick="confirmLogout()">
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
			<a href="#" class="nav-link">Courses</a>
			<form action="">
				
			</form>
			<input type="checkbox" id="" hidden>
			<label for="switch-mode" class=""></label>
			<a href="#" class="">
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
							<a href="">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="{{url('admin')}}">Home</a>
						</li>
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="{{url('/banner')}}">Announcments</a>
						</li>
					</ul>
				</div>
				
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Annoouncments</h3>

						   
						<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			
						<!-- Button trigger modal pop up -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Add Announcment
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Announcment Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	<!--  form start -->
      <div class="modal-body">
      
            <form  action="{{url('/uploadbanner')}}" method="Post" enctype="multipart/form-data">
             @csrf
          <div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Title:</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title" name="name" required>
          </div>
          <div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Description:</label>
  <textarea type="text" class="form-control" id="exampleFormControlInput1" placeholder="About the event" name="description" required></textarea>
          </div>
          <div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Image:</label>
  <input type="file" class="form-control" id="exampleFormControlInput1"  name="image" required>
          </div>

		  <button type="submit" value="Save" class="btn btn-primary">Save</button>

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
								<th>Title</th>
								<th>Description</th>
								<th>Image</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
                        @foreach($advert as $advert)
						
							<tr id="row{{ $advert->id }}">
                            <td>{{ $advert->name }}</td>
                            <td>{{ $advert->description }}</td>
                            <td>
                                <img src="{{ asset('EduLanka/public/advert/' . $advert->image) }}" alt="{{ $advert->name }}" width="150" height="150">
                            </td>
							<td>
							<a href="#" onclick="openEditModal({{ $advert->id }})">
                            <i class="bx bx-pencil bounce-icon" style="color: #449e3d; font-size: 24px;"></i>
                              </a>
							 </td>
							<td><a href="{{url('/deleteadvert',$advert->id)}}"> <i class="bx bx-trash bounce-icon" style="color: #FF0000; font-size: 24px;"  onclick="confirmDelete(event)" ></i></a>
                            </td>
								
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
                <h5 class="modal-title" id="edit-modal-label">Edit Advertisement Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <!-- Edit form -->
                <form id="editForm" action="{{ route('updateadvert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="advert_id" id="advert_id">
                    <div class="form-group">
                        <label for="name">Title:</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea type="text" class="form-control" name="description" id="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="current_image">Current Image:</label>
                        <img src="" alt="Current Image" id="current_image" width="150" height="150">
                    </div>
                    <div class="form-group">
                        <label for="new_image">New Image (leave empty to keep current image):</label>
                        <input type="file" class="form-control" name="new_image" id="new_image">
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


<!--<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>

    var availableTags = [ ];
	$.ajax({
		type: "GET",
		url: "/courselist",
		success: function(response){
			console.log(response);
		}
	});
    $( "#search_product" ).autocomplete({
      source: availableTags
    });
  
  </script>-->

  <!-- JavaScript to handle the modal -->
<script>
    function openEditModal(advertId) {
        var advertRow = document.getElementById('row' + advertId);
        var advertName = advertRow.querySelector('td:nth-child(1)').textContent;
        var advertDescription = advertRow.querySelector('td:nth-child(2)').textContent;
        var currentImageSrc = advertRow.querySelector('td:nth-child(3) img').src;

        document.getElementById('advert_id').value = advertId;
        document.getElementById('name').value = advertName;
        document.getElementById('description').value = advertDescription;
        document.getElementById('current_image').src = currentImageSrc;

        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
    }
</script>


<script>
function confirmLogout() {
    if (window.confirm('Are you sure you want to logout?')) {
        document.getElementById('logout-form').submit();
    }
}
</script>


<!--js to modal to be open-->




<script>
  // Confirmation dialog for delete
  function confirmDelete(event) {
    event.preventDefault();

    
    if (confirm("Are you sure you want to delete this courser?")) {
    
      window.location.href = event.target.parentElement.href;

      
      showSuccessMessage();
    }
  }

  // Function to show the success message
  function showSuccessMessage() {
    // You can customize the success message here
    alert("Deletion was successful!");
  }
</script>

@if(Session::has('student_added_success'))
    <script>
        alert("{{ Session::get('student_added_success') }}");
    </script>
@endif

@if(Session::has('course_edit_success'))
    <script>
        alert("{{ Session::get('course_edit_success') }}");
    </script>
@endif





	<script src="assets/script.js"></script>
</body>
</html>