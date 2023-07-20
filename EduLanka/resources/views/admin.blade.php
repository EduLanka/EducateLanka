<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="assets/admin.css">
    <!-- end if link to CSS -->
    <!-- link to jquery file for logout-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- end link to jquery file for logout-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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
			<li class="active">
				<a href="{{url('admin')}}">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
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
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
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
							<a href="{{url('admin')}}">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="">Home</a>
						</li>
					</ul>
				</div>
				
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bx-book-open' ></i>
					<span class="text">
						<h3>1020</h3>
						<p>Course Modules</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-user' ></i>
					<span class="text">
						<h3>{{ $studentCount }}</h3>
						<p>Student</p>
					</span>
				</li>
                
				<li>
					<i class='bx bx-group' ></i>
					<span class="text">
						<h3>{{ $teacherCount }}</h3>
						<p>Teacher</p>
					</span>
				</li>
                <li>
					<i class='bx bxs-user-circle' ></i>
					<span class="text">
						<h3>{{ $adminCount }}</h3>
						<p>Admin</p>
					</span>
				</li>
                <li>
					<i class='bx bx-user-check' ></i>
					<span class="text">
						<h3>{{ $parentCount }}</h3>
						<p>parent</p>
					</span>
				</li>
                <li>
					<i class='bx bx-code-alt' ></i>
					<span class="text">
						<h3>{{ $developerCount }}</h3>
						<p>Developer</p>
					</span>
				</li>
                
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>All Users</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Role</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($Student as $Student)
							<tr>
								<td>
									<p>{{ $Student->first_name }}</p>
								</td>
								<td>{{ $Student->email }}</td>
								<td>{{ $Student->role == 2}} Student </td>
							</tr>
						
                            @endforeach
							@foreach ($Teacher as $Teacher)
							<tr>
								<td>
									<p>{{ $Teacher->first_name }}</p>
								</td>
								<td>{{ $Teacher->email }}</td>
								<td>{{ $Teacher->role == 3}} Teacher</td>
							</tr>
						
                            @endforeach
							@foreach ($Admin as $Admin)
							<tr>
								<td>
									<p>{{ $Admin->full_name}}</p>
								</td>
								<td>{{ $Admin->email }}</td>
								<td>{{ $Admin->role == 1}} Admin</td>
							</tr>
						
                            @endforeach
							@foreach ($Dev as $Dev)
							<tr>
								<td>
									<p>{{ $Dev->full_name}}</p>
								</td>
								<td>{{ $Dev->email }}</td>
								<td>{{ $Dev->role == 5}} Developer</td>
							</tr>
						
                            @endforeach
							
						</tbody>
					</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>Chat Box</h3>
						<i class='bx bx-plus' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<ul class="todo-list">
					@foreach ($messages as $message)
            @php
                $senderUser = \App\Models\User::find($message->sender);
            @endphp
            <li>
                <div class="message-info">
                    <div class="avatar">
						<center><i class="bx bx-user" style="font-size: 30px;"></i></center>
                    </div>
                    <div class="message-content">
                        @if ($senderUser)
                            <h3>{{ $senderUser->name }}</h3>
                        @else
                            <h3>Unknown User</h3>
                        @endif
                        <p>{{ $message->description }}</p>
                    </div>
                
                </div>
            </li>
        @endforeach
        @if ($messages->isEmpty())
            <li class="empty-state">
                <p>No messages found.</p>
            </li>
        @endif
						
					</ul>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	




	<script src="assets/script.js"></script>
</body>
</html>