@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="main-container">

      <div class="container1">
        <div>
            <ul class="box-info">
              <li class="course-count">
                <i class='bx bx-book-open' ></i>
                <span class="text">
                  <h3>{{$courseCount}}</h3>
                  <p>My Courses</p>
                </span>
              </li>
              <li>
                <i class='bx bxs-user' ></i>
                <span class="text">
                  <h3>2</h3>
                  <p>My Students</p>
                </span>
              </li>         
              <li>
                <i class='bx bx-alarm' ></i>
                <span class="text">
                  <h3>3</h3>
                  <p>Due</p>
                </span>
              </li>
              
            </ul>
        </div>
        <div class="courses">
          <div class="cards" style="width: 50rem; height: fit-content;">
          @foreach($courses as $course)
              <div class="course">             
                <i class='bx bx-book'  style="background-color: {{ '#' . substr(md5(rand()), 0, 6) }}"></i>
                <span class="text">
                  <p><b>{{$course -> level}}</b></p>
                  <p>{{$course -> subject}}</p>
                </span>
              </div>
          @endforeach
          </div>
          <button class="learn-more">
            <span class="circle" aria-hidden="true">
            <span class="icon arrow"></span>
            </span>
            <span class="button-text">GO TO COURSES</span>
          </button>
        </div>
      </div>
      
      <div class="container2">
        <div class="cards" style="height: 38.5rem">
          <div class="card-body">
            <h5 class="card-title"><b>QUICK LINKS</b></h5>
            <br>
            <div class="links">
              <div>
                <i class="bx bx-slideshow"></i>
                <p><b>Presentation</b></p>
                <p class="link">+ Add New</p>
              </div>
              <div>
                <i class="bx bx-file"></i>
                <p><b>Document</b></p>
                <p class="link">+ Add New</p>
              </div>  
              <div>
                <i class="bx bx-link"></i>
                <p><b>Web Link</b></p>
                <p class="link">+ Add New</p>
              </div>  
              <div>
                <i class="bx bx-slideshow"></i>
                <p><b>Announcement</b></p>
                <p class="link">+ Add New</p>
              </div>
              <div>
                <i class="bx bx-video"></i>
                <p><b>Video</b></p>
                <p class="link">+ Add New</p>
              </div> 
              <div>
                <i class="bx bx-image"></i>
                <p><b>Image</b></p>
                <p class="link">+ Add New</p>
              </div>             
            </div>            
          </div>
        </div>
      </div>
      
    </div> 
  </div>  
  <br>
  <div class="row">
    <div class="performance">
      <div class="sperf">
      <div class="cards" style="height: 39rem; width: 100%;">
          <div class="card-body">
            <h5 class="card-title"><b>STUDENT PERFORMANCE</b></h5>  
            <br>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First</th>
                  <th scope="col">Last</th>
                  <th scope="col">Handle</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td colspan="2">Larry the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table>          
          </div>
        </div>

      </div>
      <div class="cperf">
      <div class="cards" style="height: 39rem; width: 100%;">
          <div class="card-body">
            <h5 class="card-title"><b>COURSE PERFORMANCE</b></h5>            
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
