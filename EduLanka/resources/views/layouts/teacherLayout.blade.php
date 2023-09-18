<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name', 'Laravel') }}</title>
      <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

      <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.svg') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

      <!-- Scripts -->
      @vite(['resources/sass/app.scss', 'resources/js/app.js'])
   </head>
   <body id="body-pd">
      <header class="header" id="header">
         <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> EduLanka : Teacher's Workspace</div>

         <a href="{{route('teacher.settings')}}">
         <div class="header_img"><img src="https://static.vecteezy.com/system/resources/previews/007/296/443/original/user-icon-person-icon-client-symbol-profile-icon-vector.jpg" alt="user-im" title="{{Auth::user()->name}}"> </div>
         </a>
      </header>
      <div class="l-navbar" id="nav-bar">
         <nav class="nav">
            <div>
               <a href="{{route('teacher.index')}}" class="nav_logo" style="text-decoration: none;"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">EduLanka</span> </a>
               <div class="nav_list">
                  <a href="{{route('teacher.index')}}" title="Dashboard" class="nav_link {{ request()->is('teacher') ? 'active' : '' }}"> <i class='bx bx-home nav_icon'></i> <span class="nav_name">Dashboard</span></a>

                  <a href="{{route('teacher.courses')}}" title="Courses" class="nav_link {{ request()->is('teacher/courses') ? 'active' : '' }}"> <i class='bx bx-book nav_icon'></i> <span class="nav_name">Courses</span> </a>

                  <a href="{{route('forum')}}" title="Forums" class="nav_link {{ request()->is('forums') ? 'active' : '' }}"> <i class='bx bx-conversation nav_icon'></i> <span class="nav_name">Forums</span> </a>

                  <a href="/chatify" title="Messages" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Messages</span> </a>

                  <a href="{{route('teacher.settings')}}" title="Settings" class="nav_link {{ request()->is('teacher/settings') ? 'active' : '' }}"> <i class='bx bx-cog nav_icon'></i> <span class="nav_name">Settings</span> </a>
                  <!-- <a href="#" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span> </a>
                  <a href="#" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Stats</span> </a>  -->
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
      <!-- @if (Session::has('success'))
         <script>
            alert('{{ Session::get('success') }}');
         </script>
      @endif -->

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
