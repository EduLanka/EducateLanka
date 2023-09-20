<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name', 'Laravel') }}</title>
      <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
      <link rel="stylesheet" href="{{asset('assets/css/calendar.css')}}">
      <link rel="stylesheet" href="{{asset('assets/css/media-student.css')}}">

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link rel="dns-prefetch" href="//fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.svg') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">



      <!-- Scripts -->
      @vite(['resources/sass/app.scss', 'resources/js/app.js'])

           <style>

            .modal-backdrop {
             background-color: transparent !important;
            }
           </style>
   </head>

         <body id="body-pd">
         <header class="header" id="header">
         <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> EduLanka : Student's Workspace</div>


<!-- resources/views/students/search.blade.php -->
<div class="search">
    <form id="search-form">
        <input name="query" placeholder="Search Course..." type="search">
        <button type="submit"><i class="bx bx-search"></i></button>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Search Results</h5>
            </div>
            <div class="modal-body">
                <ul id="search-results"></ul>
            </div>
        </div>
    </div>
</div>

         <!--Student Setting-->
         <a href="{{route('student.settings')}}">
         <div class="header_img"><img src="https://static.vecteezy.com/system/resources/previews/007/296/443/original/user-icon-person-icon-client-symbol-profile-icon-vector.jpg" alt="user-im" title="{{Auth::user()->name}}"> </div>
         </a>

      </header>

      <div class="l-navbar" id="nav-bar">
         <nav class="nav">
            <div>
               <a href="{{route('student')}}" class="nav_logo" style="text-decoration: none;"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">EduLanka</span> </a>
               <div class="nav_list">
                  <a href="{{route('student')}}" title="Dashboard" class="nav_link {{ request()->is('student') ? 'active' : '' }}"> <i class='bx bx-home nav_icon'></i> <span class="nav_name">Dashboard</span></a>

                  <a href="{{route('student.courses')}}" title="Courses" class="nav_link {{ request()->is('student/courses') ? 'active' : '' }}"> <i class='bx bx-book nav_icon'></i> <span class="nav_name">Courses</span> </a>

                  <a href="{{route('forum')}}" title="Forums" class="nav_link {{ request()->is('forums') ? 'active' : '' }}"> <i class='bx bx-conversation nav_icon'></i> <span class="nav_name">Forums</span> </a>

                  <a href="/chatify" title="Messages" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Messages</span> </a>

                  <a href="{{ route('my-progress') }}" title="My Progress" class="nav_link {{ request()->is('my-progress') ? 'active' : '' }}"> <i class='bx bx-chart nav_icon'></i> <span class="nav_name">My Progress</span> </a>

                  <a href="{{route('student.settings')}}" title="Settings" class="nav_link {{ request()->is('student/settings') ? 'active' : '' }}"> <i class='bx bx-cog nav_icon'></i> <span class="nav_name">Settings</span> </a>
                </div>
            </div>
            <a class="nav_link" title="SignOut" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class='bx bx-log-out nav_icon'></i> <span class="nav_name" >SignOut</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <!-- <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a> -->
         </nav>
      </div>
      <!--Container Main start-->
      <div id="body-pd" class="py-4">
         @yield('content')
      </div>
      <!--Container Main end-->
      @if (Session::has('success'))
         <script>
            alert('{{ Session::get('success') }}');
         </script>
      @endif
      <script src="{{ asset('assets/js/app.js') }}" defer></script>
      <script src="{{ asset('assets/js/password-validation.js') }}" defer></script>
      <script src="{{ asset('assets/js/navbar.js') }}" defer></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>




<script>
    $(document).ready(function() {
        $('#search-form').submit(function(event) {
            event.preventDefault();

            var query = $('input[name="query"]').val();

            $.ajax({
                type: 'GET',
                url: '{{ route('students.search') }}',
                data: { query: query },
                success: function(response) {
                    var courses = response.courses;
                    var resultList = $('#search-results');
                    resultList.empty();

                    if (courses.length > 0) {
                        courses.forEach(function(course) {
                            resultList.append('<li>' + course.level + ' - Subject: ' + course.subject + '</li>');
                        });
                    } else {
                        resultList.append('<li>No results found.</li>');
                    }

                    $('#searchModal').modal('show');
                },
                error: function() {
                    console.log('Error occurred while fetching search results.');
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewResultsButton = document.querySelector('.learn-more1');

        viewResultsButton.addEventListener('click', function () {

            const courseId = this.getAttribute('data-course-id');
            const studentId = this.getAttribute('data-student-id');

            console.log(courseId);
            console.log(studentId);

            // Use courseId and studentId to fetch submission results data
            // After retrieving the data, populate the modal with submission titles
            const modalContent = document.querySelector('.modal-content');
            modalContent.innerHTML = ''; // Clear previous content


            const submissionData = [
                // Sample data objects with title properties
                { title: 'Submission 1 Title' },
                { title: 'Submission 2 Title' },
                // ...more submission data
            ];

            submissionData.forEach(submission => {
                const submissionTitleElement = document.createElement('p');
                submissionTitleElement.textContent = submission.title;
                modalContent.appendChild(submissionTitleElement);
            });

            // Open the modal
            const modal = new bootstrap.Modal(document.getElementById('resultsModal'));
            modal.show();
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
