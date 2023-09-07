<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Parent Dashboard</title>
  <link rel="stylesheet" href="style.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('assets/css/parent.css')}}">

</head>
<body>
  <div class="container">
    <nav>
      <ul>
        <li>
          <a href="#" class="logo"><span class="nav-item">Edu Lanka</span></a></li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
          </form>
        </li>
        <li>
          <a href="{{ route('logout') }}" class="nav_link" title="SignOut" id="signout"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span class="nav-item">Sign Out</span>
          </a>
        </li>
      </ul>
    </nav>

    <section class="main">
        
      <div class="main-top">
      </div>
      <h1>Parents Dashboard</h1>
      <br>

      <!-- <button class="cntteacher">
        <span class="circle" aria-hidden="true">
        <span class="icon arrow"></span>
        </span>
        <span class="button-text">Contact Teacher</span>
      </button> -->

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



      <button class="settings">
        <span class="circle" aria-hidden="true">
        <span class="icon arrow"></span>
        </span>
        <span class="button-text">Settings</span>
      </button>

      <br>

      <h1>My Student</h1>
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
      

     

      <h1>Student Subjects</h1>
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

      <!-- <section class="main-course">
        <h1>Student course assigment</h1>
        <div class="course-box">
          <ul>
            <li class="active">In progress</li>
           
            <li>Upcoming</li>
            <li>finished</li>
          </ul>
          <div class="course">
            <div class="box">
              <h3>HTML</h3>
              <p>80% - progress</p>
              <button>continue</button>
              <i class="fab fa-html5 html"></i>
            </div>
            <div class="box">
              <h3>CSS</h3>
              <p>50% - progress</p>
              <button>continue</button>
              <i class="fab fa-css3-alt css"></i>
            </div>
            <div class="box">
              <h3>JavaScript</h3>
              <p>30% - progress</p>
              <button>continue</button>
              <i class="fab fa-js-square js"></i>
            </div>
          </div>
        </div>
      </section> -->
    </section>
  </div>
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
</body>
</html>