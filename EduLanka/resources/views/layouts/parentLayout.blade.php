<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name', 'Laravel') }}</title>
      <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
      <link rel="stylesheet" href="{{asset('assets/css/parent.css')}}">
      <link rel="stylesheet" href="{{asset('assets/css/media-parent.css')}}">

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link rel="dns-prefetch" href="//fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.svg') }}">
   

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/logos/apple-touch-icon.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/logos/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/logos/favicon-16x16.png')}}">
<link rel="manifest" href="{{ asset('/manifest.json') }}">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">



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
         <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> EduLanka : Parent's Workspace</div>

         <a href="{{route('parent.settings')}}">
         <div class="header_img"><img src="https://static.vecteezy.com/system/resources/previews/007/296/443/original/user-icon-person-icon-client-symbol-profile-icon-vector.jpg" alt="user-im" title="{{Auth::user()->name}}"> </div>
         </a>

      </header>

      <div class="l-navbar" id="nav-bar">
         <nav class="nav">
            <div>
               <a href="{{route('parent')}}" class="nav_logo" style="text-decoration: none;"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">EduLanka</span> </a>
               <div class="nav_list">
                 
                  <a href="{{route('parent.settings')}}" title="Settings" class="nav_link {{ request()->is('parent/settings') ? 'active' : '' }}"> <i class='bx bx-cog nav_icon'></i> <span class="nav_name">Settings</span> </a>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>





  <script>
    $(document).ready(function () {
        $('.check-performance-btn').click(function () {
            const courseID = $(this).data('course-id');
            const submissionIDs = $(this).data('submission-ids');

            console.log('Course ID:', courseID);
            console.log('Submission IDs (raw):', submissionIDs);

            // Make an AJAX request to fetch the link count
            $.ajax({
                url: '/getCount/' + courseID, // Update the URL to your Laravel route
                method: 'GET',
                success: function (data) {
                    // Update the "total" <p> tag with the received link count
                    const totalP = $('#total');
                    totalP.html('Total : ' + data.linkCount);
                },
                error: function () {
                    // Handle the case where the link count cannot be fetched
                    console.log('Error fetching link count');
                }
            });


            $.ajax({
                url: '/getDueCount/' + courseID, // Update the URL to your Laravel route
                method: 'GET',
                success: function (data) {
                    // Update the "due" <p> tag with the received due link count
                    const dueP = $('#due');
                    dueP.html('Due : ' + data.dueLinkCount);
                },
                error: function () {
                    // Handle the case where the due link count cannot be fetched
                    console.log('Error fetching due link count');
                }
            });


            // Check if submissionIDs is an array
            if (Array.isArray(submissionIDs)) {
                // Populate the table with submission details
                const courseMatTable = $('#course-mat');
                courseMatTable.empty();

                submissionIDs.forEach(function (submissionID) {
                    // Make an AJAX request to fetch submission details
                    $.ajax({
                        url: '/getSubmissionDetails/' + submissionID, // Update the URL to your Laravel route
                        method: 'GET',
                        success: function (data) {
                            // Assuming the data returned is an object with submission details
                            courseMatTable.append(
                                '<tr>' +
                                    '<td>' + data.title + '</td>' +
                                    '<td>' + data.upload_date + '</td>' +
                                    '<td>' + data.total_marks + '</td>' +
                                    '<td>' + data.grade + '</td>' +
                                    '<td>' + data.feedback + '</td>' +
                                '</tr>'
                            );
                        },
                        error: function () {
                            // Handle the case where submission details cannot be fetched
                            console.log('Error fetching submission details');
                        }
                    });
                });
            } else if (typeof submissionIDs === 'string' || typeof submissionIDs === 'number') {
                // It's a single value, so display it
                const submissionIdsList = $('#submission-ids-list');
                submissionIdsList.html('<p>' + submissionIDs + '</p>');
            } else {
                // Handle other cases (e.g., display an error message)
                const submissionIdsList = $('#submission-ids-list');
                submissionIdsList.html('<p>No submission IDs available.</p>');
            }
        });
    });

    var courseLabels = [];
    var courseAverages = [];

    @foreach($courses as $course)
        courseLabels.push("{{$course->level}} - {{$course->subject}}");
        courseAverages.push({{ $courseAverages[$course->id] }});
    @endforeach

    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: courseLabels,
            datasets: [{
                label: 'Course Average',
                data: courseAverages,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
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
