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

      <style>
      button {
      position: relative;
      display: inline-block;
      cursor: pointer;
      outline: none;
      border: 0;
      vertical-align: middle;
      text-decoration: none;
      background: transparent;
      padding: 0;
      font-size: inherit;
      font-family: inherit;
      }

      button.settings{
      width: 12rem;
      height: auto;
      }

      button.settings .circle {
      transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
      position: relative;
      display: block;
      margin: 0;
      width: 3rem;
      height: 3rem;
      background: #282936;
      border-radius: 1.625rem;
      }

      button.settings .circle .icon {
      transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
      position: absolute;
      top: 0;
      bottom: 0;
      margin: auto;
      background: #fff;
      }

      button.settings .circle .icon.arrow {
      transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
      left: 0.625rem;
      width: 1.125rem;
      height: 0.125rem;
      background: none;
      }

      button.settings .circle .icon.arrow::before {
      position: absolute;
      content: "";
      top: -0.29rem;
      right: 0.0625rem;
      width: 0.625rem;
      height: 0.625rem;
      border-top: 0.125rem solid #fff;
      border-right: 0.125rem solid #fff;
      transform: rotate(45deg);
      }

      button.settings .button-text {
      transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      padding: 0.75rem 0;
      margin: 0 0 0 1.85rem;
      color: #282936;
      font-weight: 700;
      line-height: 1.6;
      text-align: center;
      text-transform: uppercase;
      }

      button:hover .circle {
      width: 100%;
      }

      button:hover .circle .icon.arrow {
      background: #fff;
      transform: translate(1rem, 0);
      }

      button:hover .button-text {
      color: #fff;
      }
      </style>

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
</body>
</html>

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('parent Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div> -->

            <!--contact admin-->
            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              Contact Admin
            </button> -->

            <!-- Modal -->
            <!-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Share your thoughts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="POST" action="{{ url('sendMessage') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body"> -->
                      <!--form start -->
                      <!-- <div class="mb-3">

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
                               end of form -->

                    <!-- </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                  </form>
                </div>
              </div>
            </div> -->
            <!--End of modal-->


            <!--change password-->
            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
              Change Password
            </button> -->
        <!-- </div>
    </div>
</div> -->
