@extends('layouts.teacherLayout')

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
                  <h3>{{$totalStudentCount}}</h3>
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
                <i class="bx bx-music"></i>
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
              <div class="select-course">
                <!-- <label for="course">Select Course</label> -->
                <select id="course" name="course">
                  <option disabled selected>Select Course</option>
                  @foreach($courses as $course) 
                    <option value="{{$course->id}}">{{$course->level}}: {{$course->subject}}</option>
                  @endforeach
                </select>
              </div>
                <br>
              <br>
              <table class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th scope="col">Student Name</th>
                    <th scope="col">Student ID</th>
                    <th scope="col">Average Score</th>
                    <!-- <th scope="col">Handle</th> -->
                  </tr>
                </thead>
                <!-- <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    
                  </tr>
                </tbody> -->
                <tbody id="student-table-body">
                  <!-- Students will be dynamically added here -->
              </tbody>
              </table>  
              
        
            </div>
        </div>
      </div>

      <div class="cperf">
        <div class="cards" style="height: 39rem; width: 100%;">
          <div class="card-body">
            <h5 class="card-title"><b>COURSE PERFORMANCE</b></h5> 
            <br>
            <br> 
            <table class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th scope="col">Course</th>
                    <th scope="col">Average Score</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                  <tr>
                    <th scope="row">{{$course->level}} {{$course->subject}}</th>

                    <!-- if assignments are submitted under the course for an average to be caculated, then average is displayed. or else N/A is displayed -->
                    <td>{{$course->average_score !== null ? $course->average_score : 'N/A'}}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>           
          </div>
        </div>

      </div>


    </div>
  </div>

  <!--contact admin-->
  <button type="button" class="admin-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
     <i class="bx bx-message-dots"></i>
  </button>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Share your thoughts</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ url('sendMessage') }}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <!--form start -->
            <div class="mb-3">

              <label for="topic" class="form-label">Reason of contact</label>

              <select name="topic" id="topic" class="form-control">
                <option value="Ask a question" class="form-control" name="topic">Ask a question</option>
                <option value="Leave a comment" class="form-control" name="topic">Leave a comment</option>
                <option value="Report a bug" class="form-control" name="topic">Report a bug</option>
                <option value="Suggest an improvement" class="form-control" name="topic">Suggest an improvement</option>
                <option value="other" class="form-control" name="topic">Other</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
            </div>
                    <!-- end of form -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--End of modal-->
</div>
@endsection
