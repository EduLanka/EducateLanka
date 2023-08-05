@extends('layouts.teacherLayout')

@section('content')
<p>MY COURSES</p>
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
        <p><b>COURSE MATERIAL</b></p>
        <button type="button" id="addM" data-bs-toggle="modal" data-bs-target="#staticBackdropPre">
                   <i class="bx bx-plus"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdropPre" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                <table class="table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Upload Date</th>
                        </tr>
                    </thead>
                    <tbody id="course-mat">
                        <!--  rows will be dynamically added here -->
                    </tbody>
                </table>

                

            </div>
        </div>
    </div>
    <div class="participants">
        <p>Course participants</p>
        <table class="table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
            </tr>
        </thead>
        <tbody id="course-parti">
            <!-- Student rows will be dynamically added here -->
        </tbody>
    </table>
    </div>
</div>
<br>
<div class="assignments">
    <p>Assignments</p>
    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Due Date</th>
                <th>Upload Date</th>
                <th>Student ID</th>
                <th>Marks</th>
                <th>Grade</th>
                <th>Feedback</th>
            </tr>
        </thead>
        <tbody id="course-assign">
            <!-- Assignment rows will be dynamically added here -->
        </tbody>
    </table>
</div>



@endsection