<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/setting.css">
	<title>Document</title>
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
					<span class="text">Adevert</span>
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
			<a href="#" class="nav-link">Dashboard</a>
			<form action="#">
				
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
					<h1>Settings</h1>
					
				</div>
				
			</div>              

<form class="form">
    <p class="title">Edit profile </p>
    <p class="message"> </p>
        <div class="flex">
        <label>
            <input required="" placeholder="" type="text" class="input">
            <span>Firstname</span>
        </label>

        <label>
            <input required="" placeholder="" type="text" class="input">
            <span>Lastname</span>
        </label>
    </div>  
            
    <label>
        <input required="" placeholder="" type="email" class="input">
        <span>Email</span>
    </label> 

	<label>
        <input required="" placeholder="" type="address" class="input">
        <span>Address</span>
    </label> 
        
    <label>
        <input required="" placeholder="" type="telno" class="input">
        <span>Contact No</span>
    </label>

    <button class="submit">Save</button>
   
</form>

<br><br>

<form class="form">
    <p class="title">Change Password </p>
    <p class="message"> </p>
        <div class="flex">
        <label>
            <input required="" placeholder="" type="password" class="input">
            <span>Old Password</span>
        </label>

        <label>
            <input required="" placeholder="" type="password" class="input">
            <span>New Password</span>
        </label>
    </div>  
            
    <label>
        <input required="" placeholder="" type="password" class="input">
        <span>Confirm New Password</span>
    </label> 

    <button class="submit">Update</button>
   
</form>

			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	




	<script src="assets/script.js"></script>
</body>
</html>
