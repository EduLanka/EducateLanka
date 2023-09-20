@extends('layouts.parentLayout')

@section('content')

  <button type="button" title="Contact Admin" class="CntAdmin" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  <span class="circle" aria-hidden="true">
      <span class="icon arrow"></span>
      </span>
      <span class="button-text">Contact Admin</span>
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
            <p>
            This dedicated communication channel in EduLanka ensures that any queries, concerns, or valuable input you have are channeled to our administrative team for prompt attention, enhancing the overall quality of your experience.</p>
            <!--form start -->
            <div class="mb-3">

              <label for="topic" class="form-label">Reason of contact</label>

              <select name="topic" id="topic" class="form-control" required>
                <option value="Ask a question" class="form-control" name="topic">Ask a question</option>
                <option value="Leave a comment" class="form-control" name="topic">Leave a comment</option>
                <option value="Report a bug" class="form-control" name="topic">Report a bug</option>
                <option value="Suggest an improvement" class="form-control" name="topic">Suggest an improvement</option>
                <option value="other" class="form-control" name="topic">Other</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required></textarea>
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


      <br>

      <br>
      <br>
      <h4><b>My Student</b></h4>
      <div class="top">
        <div class="my-student">
          <div class="details">
          
          @if ($student)
              <center><img src="{{ asset('assets/images/userImage.jpg') }}" alt="user image"></center> 
              <p><b>ID:</b> <span class="label-content">{{$student->user_id}}</span></p>
              <p><b>Full Name:</b> <span class="label-content">{{$student->first_name}} {{$student->last_name}}</span></p>
              <p><b>Email address:</b> <span class="label-content">{{$student->email}}</span></p>
              <p><b>Level:</b> <span class="label-content">{{$student->level}}</span></p>
          @else
              <p>No student found!</p>
          @endif
          </div>
        </div>

        <div>
         <canvas id="myChart"></canvas>
        </div>
        
      </div>
      

     
      <br>
      <br>
      <h4><b>My Student's Courses</b></h4>
      <div class="main-skills">
      @if($courses)
        @foreach($courses as $course)
        <div class="card">
            <i class="fas fa-laptop-code"></i>
            <h3>{{$course->subject}}</h3>
            <p>{{$course->level}}</p>
            <button class="check-performance-btn" data-course-id="{{$course->id}}" data-submission-ids="{{ json_encode($submissions[$course->id]->pluck('id')) }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Check Performance</button>
            <a href="/chatify/{{$course->teacher_id}}"> <button class="contact-teacher-btn">Contact Teacher</button></a>
           


            <!-- Modal -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Student Performance</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">❌</button> -->
            </div>
            <div class="modal-body">
              <h6>Student Submissions</h6>
              <div class="links">
                <p id="total"></p>
                <!-- <p id="done"></p> -->
                <p id="due"></p>
              </div>

    <div id="submission-ids-list"></div>
    <div class="tb">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Marks</th>
                <th>Grade</th>
                <th>Feedback</th>
            </tr>
        </thead>
        <tbody id="course-mat">
            <!-- Content will be dynamically added here -->
        </tbody>
    </table>
    </div>
    
</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
        </div>
        @endforeach
      @else
          <p>No subjects found for this student.</p>
      @endif



        


      </div>

     
    </section>
  </div>

 
  @endsection
