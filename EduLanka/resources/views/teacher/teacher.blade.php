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
                  <h3>{{$courses->sum('due_assignments_count')}}</h3>
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
          <a href="{{route('teacher.courses')}}">
          <button class="learn-more">
            <span class="circle" aria-hidden="true">
            <span class="icon arrow"></span>
            </span>
            <span class="button-text">GO TO COURSES</span>
          </button>
        </a>
        </div>
      </div>
      
      <div class="container2">
        <div class="cards" style="height: 38.5rem">
          <div class="card-body">
            <h5 class="card-title"><b>QUICK LINKS</b></h5>
            <br>
            <div class="links">

            <!--add presentation-->
              <div>
                <i class="bx bx-slideshow"></i>
                <p><b>Presentation</b></p>
                <button type="button" class="link" data-bs-toggle="modal" data-bs-target="#staticBackdropPre">
                   + Add New
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdropPre" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Presentation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{ route('teacher.material.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                          <!--form start -->
                          <div class="mb-3">
                            <label for="type" class="form-label">Material Type</label>
                            <input type="text" class="form-control" id="type" value="Presentation" name="type" required readonly>
                          </div>

                          <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                          </div>

                          <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <input type="file" class="form-control" id="content"  name="content" accept=".pptx" required>
                          </div>

                          <label for="course" class="form-label">Select Course</label>
                          <select id="course" name="course" class="form-control">
                            @foreach($courses as $course) 
                              <option value="{{$course->id}}">{{$course->level}}: {{$course->subject}}</option>
                            @endforeach
                          </select>

                          
                                  <!-- end of form -->

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!--End of modal-->

              </div>

              <!--add document-->
              <div>
                <i class="bx bx-file"></i>
                <p><b>Document</b></p>
                <button type="button" class="link" data-bs-toggle="modal" data-bs-target="#staticBackdropDoc">
                   + Add New
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdropDoc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Document</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{ route('teacher.material.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                          <!--form start -->
                          <div class="mb-3">
                            <label for="type" class="form-label">Material Type</label>
                            <input type="text" class="form-control"  value="Document" name="type" required readonly>
                          </div>

                          <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control"  name="title" required>
                          </div>

                          <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <input type="file" class="form-control"   name="content" accept=".docx,.pdf" required>
                          </div>

                          <label for="course" class="form-label">Select Course</label>
                          <select name="course" class="form-control">
                            @foreach($courses as $course) 
                              <option value="{{$course->id}}">{{$course->level}}: {{$course->subject}}</option>
                            @endforeach
                          </select>

                          
                                  <!-- end of form -->

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!--End of modal-->
              </div>  

              <!--add link-->
              <div>
                <i class="bx bx-link-external"></i>
                <p><b>Web Link</b></p>
                <button type="button" class="link" data-bs-toggle="modal" data-bs-target="#staticBackdropLink">
                   + Add New
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdropLink" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Web Link</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{ route('teacher.material.addlink') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                          <!--form start -->
                          <div class="mb-3">
                            <label for="type" class="form-label">Material Type</label>
                            <input type="text" class="form-control"  value="Web Link" name="type" required readonly>
                          </div>

                          <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control"  name="title" required>
                          </div>

                          <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <input type="url" class="form-control"   name="content" placeholder="Enter link" required>
                          </div>

                          <label for="course" class="form-label">Select Course</label>
                          <select name="course" class="form-control">
                            @foreach($courses as $course) 
                              <option value="{{$course->id}}">{{$course->level}}: {{$course->subject}}</option>
                            @endforeach
                          </select>

                          
                                  <!-- end of form -->

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!--End of modal-->

              </div>
              
              
              <div>
                <i class="bx bx-music"></i>
                <p><b>Announcement</b></p>
                <button type="button" class="link" data-bs-toggle="modal" data-bs-target="#staticBackdropAnn">
                   + Create New
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdropAnn" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create New Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{ route('teacher.announce.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                          <!--form start -->
                          <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control"  name="name" required>
                          </div>

                          <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <textarea type="text" name="desc" class="form-control"
                            required></textarea>
                          </div>

                          <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control"   name="image" accept=".png,.jpg,.jpeg" required>
                          </div>

                          <!-- <label for="course" class="form-label">Select Course</label>
                          <select name="course" class="form-control">
                            @foreach($courses as $course) 
                              <option value="{{$course->id}}">{{$course->level}}: {{$course->subject}}</option>
                            @endforeach
                          </select>

                           -->
                                  <!-- end of form -->

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!--End of modal-->

              </div>
              <div>
                <i class="bx bx-video"></i>
                <p><b>Video</b></p>
                <button type="button" class="link" data-bs-toggle="modal" data-bs-target="#staticBackdropVid">
                   + Add New
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdropVid" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{ route('teacher.material.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                          <!--form start -->
                          <div class="mb-3">
                            <label for="type" class="form-label">Material Type</label>
                            <input type="text" class="form-control" id="type" value="Video" name="type" required readonly>
                          </div>

                          <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                          </div>

                          <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <input type="file" class="form-control" id="content"  name="content" accept=".mp4" required>
                          </div>

                          <label for="course" class="form-label">Select Course</label>
                          <select id="course" name="course" class="form-control">
                            @foreach($courses as $course) 
                              <option value="{{$course->id}}">{{$course->level}}: {{$course->subject}}</option>
                            @endforeach
                          </select>

                          
                                  <!-- end of form -->

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!--End of modal-->
              </div>
              
              
              <div>
                <i class="bx bx-image"></i>
                <p><b>Image</b></p>
                <button type="button" class="link" data-bs-toggle="modal" data-bs-target="#staticBackdropImg">
                   + Add New
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdropImg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{ route('teacher.material.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                          <!--form start -->
                          <div class="mb-3">
                            <label for="type" class="form-label">Material Type</label>
                            <input type="text" class="form-control" id="type" value="Image" name="type" required readonly>
                          </div>

                          <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                          </div>

                          <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <input type="file" class="form-control" id="content"  name="content" accept=".png,.jpg,.jpeg" required>
                          </div>

                          <label for="course" class="form-label">Select Course</label>
                          <select id="course" name="course" class="form-control">
                            @foreach($courses as $course) 
                              <option value="{{$course->id}}">{{$course->level}}: {{$course->subject}}</option>
                            @endforeach
                          </select>

                          
                                  <!-- end of form -->

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!--End of modal-->

              </div>  
              <div>
                <i class="bx bx-link"></i>
                <p><b>Submission Link</b></p>
                <button type="button" class="link" data-bs-toggle="modal" data-bs-target="#staticBackdropSLink">
                   + Create New
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdropSLink" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create New Submission Link</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{ route('teacher.sublink.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                          <!--form start -->
                          <div class="mb-3">
                            <label for="course" class="form-label">Select Course</label>
                            <select id="course" name="course" class="form-control">
                              @foreach($courses as $course) 
                                <option value="{{$course->id}}">{{$course->level}}: {{$course->subject}}</option>
                              @endforeach
                            </select>
                          </div>
                          
                          <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" required>
                          </div>

                          <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <textarea type="text" name="desc" class="form-control"
                            required></textarea>
                          </div>

                          <div class="mb-3">
                            <label for="date" class="form-label">Due Date</label>
                            <input type="date" class="form-control" name="date" required>
                          </div>

                          <div class="mb-3">
                            <label for="marks" class="form-label">Total Marks Avaliable</label>
                            <input type="number" class="form-control" id="marks" name="marks" required>
                          </div>

                          

                          
                                  <!-- end of form -->

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!--End of modal--> 
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

    <!--Student Performance-->
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
  <button type="button" title="Contact Admin" class="admin-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
     <i class="bx bx-message-dots"></i>
     <!-- <p>Contact Admin</p> -->
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


 
@endsection
