@extends('layouts.teacherLayout')

@section('content')
<p><b>MY COURSES : Select a course to view details</b></p>
<div class="option-container">
    <div class="option-selection">
        @foreach($courses as $course)
            <input type="radio" id="course-{{$course->id}}" name="selected_course" value="{{$course->id}}" data-course-name="{{$course->level}} {{$course->subject}}">
            <label class="option-label" for="course-{{$course->id}}">{{$course->level}} {{$course->subject}}</label>
        @endforeach
    </div>
</div>
<br>
<br>
<div class="coursesgrid">
    <div class="material">
        <p><b>COURSE MATERIALS</b></p>
        <button type="button" id="addM" data-bs-toggle="modal" data-bs-target="#staticBackdropAdd">
                   <i class="bx bx-plus"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdropAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Material</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{ route('teacher.material.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                          <!--form start -->
                          <div class="mb-3">
                            <label for="type" class="form-label">Material Type</label>
                            <select name="type" class="form-control">
                              <option value="Presentation">Presentation</option>
                              <option value="Document">Document</option>
                              <option value="Document">Web Link</option>
                              <option value="Document">Video</option>
                              <option value="Document">Image</option>
                              
                          </select>
                          </div>

                          <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                          </div>

                          <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <input type="file" class="form-control" id="content"  name="content" required>
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
        <div class="materialgrid">
            <div class="materialType">
                <i class="bx bx-slideshow" id="ic-pres" title="Presentation"></i>
                <i class="bx bx-file" title="Document"></i>
                <i class="bx bx-link" title="Web Link"></i>
                <i class="bx bx-video" title="Video"></i>
                <i class="bx bx-image" title="Image"></i>
            </div>
            <div class="materialss">
                <p>Select Material Type</p>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Upload Date</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="course-mat">
                        <!--  rows will be dynamically added here -->
                    </tbody>
                </table>

                

            </div>

            <!-- Modal for Edit Material -->
            <div class="modal" id="editMaterialModal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form id="editMaterialForm" action="{{ route('teacher.material.edit') }}"  method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <input id="materialId" name="materialId" type="hidden"> 
                      

                    <div class="mb-3">
                            <label for="materialType" class="form-label">Material Type</label>
                            <select name="materialType" id="materialType"  class="form-control">
                              <option value="Presentation">Presentation</option>
                              <option value="Document">Document</option>
                              <option value="Web Link">Web Link</option>
                              <option value="Video">Video</option>
                              <option value="Image">Image</option>
                              
                          </select>
                          </div>

                          <div class="mb-3">
                            <label for="materialTitle"  class="form-label">Title</label>
                            <input type="text" class="form-control" id="materialTitle" name="materialTitle" required>
                          </div>

                          <div class="mb-3">
                            <label for="materialContent" class="form-label">Content</label>
                            <input type="file" class="form-control" id="materialContent"  name="materialContent">
                          </div>

                      <br>
                      <br>
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>


                       

        </div>
    </div>
    <div class="participants">
        <p><b>COURSE PARTICIPANTS</b></p>
        <table class="table table-hover table-striped">
          <thead>
              <tr>
                  <th>Student ID</th>
                  <th>Student Name</th>
                  <th></th>
              </tr>
          </thead>
          <tbody id="course-parti">
              <!-- Student rows will be dynamically added here -->
          </tbody>
       </table>
    </div>
</div>

<div id="contactModal" class="modal">
    <div class="modal-content">
   
        <span class="close" id="closeModal1">&times;</span>
        <br>
        <br>
        <div class="contactbtns">
          <div class="btn1">
            <i class="bx bx-user" title="Contact Student"></i>
            <br>
            <br>
            <a id="contact-s" class="contact-icon" data-student-id=""><b>Contact Student</b></a>
          </div>
          <div class="btn2">
            <i class="bx bx-user" title="Contact Parent"></i>
            <br>
            <br>
            <a id="contact-p" class="contact-icon" data-guardian-id=""><b>Contact Parent</b></a>
          </div>
        </div>
        <!-- <a id="contact-s" class="btn btn-primary contact-icon" data-student-id="">Contact Student</a>
        <br>
        <a id="contact-p" class="btn btn-primary contact-icon" data-guardian-id="">Contact Parent</a> -->
    </div>
</div>


<br>
<div class="submissions">
    <p><b>SUBMISSIONS</b></p>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Submission ID</th>   
                <th>Title</th>      
                <th>Upload Date</th>
                <th>Student ID</th>
                <th>Link ID</th>
                <th>Marks</th>
                <th>Grade</th>
                <th>Feedback</th>
                <th>Download</th>
                <th>Mark</th>
            </tr>
        </thead>
        <tbody id="course-sub">
           
           
        </tbody>
    </table>

</div>

<!-- The modal structure -->
<div id="commentModal" class="modal">
    <div class="modal-content">
   
        <span class="close" id="closeModal">&times;</span>
        <br>
        <br>
        <form id="commentForm" method="POST" action="{{ route('teacher.sub.grade')}}">
          @csrf
          @method('PUT')

          <input type="hidden" id="id" name="id" required>

            <label for="marks" class="form-label">Marks</label>
            <input type="number" id="marks" name="marks"  required>

            <label for="grade" class="form-label">Grade</label>
            <input type="text" id="grade" name="grade" readonly required>

            <label for="feedback">Feedback</label>
            <textarea id="feedback" name="feedback" rows="4" cols="50"></textarea>

            <!-- <label for="comment">Add Comment:</label>
            <textarea id="comment" name="comment" rows="4" cols="50"></textarea > -->
            <button type="submit" id="markSub">Save</button>
        </form>
    </div>
</div>




@endsection