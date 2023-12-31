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

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.svg') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
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
			<li>
				<a href="{{url('/banner')}}">
					<i class='bx bx-image-add' ></i>
					<span class="text">Announcement</span>
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
			<a href="#" class="nav-link">Dashboard</a>
			<form action="#">

			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="" class="notification">
				<i class='bx bxs-message' ></i>
				<span class="num">{{$messageCount}}</span>
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
						<h3>{{$courseCount}}</h3>
						<p>Course Modules</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-user' ></i>
					<span class="text">
						<h3>{{ $studentCount }}</h3>
						<p>Students</p>
					</span>
				</li>

				<li>
					<i class='bx bx-group' ></i>
					<span class="text">
						<h3>{{ $teacherCount }}</h3>
						<p>Teachers</p>
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
						<p>Parents</p>
					</span>
				</li>
				<li>
					<i class='bx bx-image-add' ></i>
					<span class="text">
						<h3>{{ $bannerCount }}</h3>
						<p>Announcements</p>
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


						</tbody>
					</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>Chat Box</h3>
						<i class='bx bx-plus' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<div class="messages">
    @foreach ($messages as $message)
        @php
            $senderUser = \App\Models\User::find($message->sender);
        @endphp
        <div class="message">
			<div class="top">
				<div class="message-info">
					<div class="avatar">
						<i class="bx bx-user" style="font-size: 30px;"></i>
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
				<div class="reply">
					<button type="button" class="btn btn-primary reply-btn" onclick="toggleReplyArea(this)">
					<i class="bx bx-reply" style="font-size: 30px;"></i></button>
				</div>
			</div>
			<div class="reply-area">
				@if(!is_null($message->reply))
				<p>You have already replied to this message.</p>
				<p>Reply: {{$message->reply}}</p>
				@else
				<form method="POST" action="{{ url('replyMessage',$message->id) }}" enctype="multipart/form-data">
				@csrf
					<input type="text" placeholder="Type your reply..." name="reply">
					<button class="btn btn-success send-button" type="submit">
						<i class="bx bx-send" style="font-size: 30px;"></i>
					</button>
				</form>
				@endif
            </div>
        </div>


    @endforeach
    @if ($messages->isEmpty())
        <div class="empty-state">
            <p>No messages found.</p>
        </div>
		@endif

				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

<footer>

	Copyright &copy; <script>document.write(new Date().getFullYear())</script> Edu Lanka  All Right Reseved <span class="tab1">The Best Learning platform</span> </marquee>


</footer>

<script>
function confirmLogout() {
    if (window.confirm('Are you sure you want to logout?')) {
        document.getElementById('logout-form').submit();
    }
}
</script>



	<script src="assets/script.js"></script>
	<script>
  function toggleReplyArea(replyButton) {
    const replyArea = replyButton.closest('.message').querySelector('.reply-area');
    replyArea.style.display = replyArea.style.display === 'block' ? 'none' : 'block';
  }

  document.addEventListener('DOMContentLoaded', () => {
    const replyButtons = document.querySelectorAll('.reply-button');
    replyButtons.forEach((button) => {
      button.addEventListener('click', () => {
        toggleReplyArea(button);
      });
    });
  });
</script>
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if ("serviceWorker" in navigator) {
        // Register a service worker hosted at the root of the
        // site using the default scope.
        navigator.serviceWorker.register("/sw.js").then(
        (registration) => {
            console.log("Service worker registration succeeded:", registration);
        },
        (error) => {
            console.error(`Service worker registration failed: ${error}`);
        },
        );
    } else {
        console.error("Service workers are not supported.");
    }
</script>
</body>
</html>
