@extends('layouts.studentLayout')

@section('content')
<div id="course-data" data-course-id="{{ $courseId }}"></div>
<h3><b>{{ $course->level }} {{ $course->subject }}</b></h3>

@if ($instructor)
    <p><b>Course Instructor</b>: {{ $instructor->first_name }} {{ $instructor->last_name }}</p>
@else
    <p>No instructor information available for this course.</p>
@endif
<div class="coursesgrid">
<div class="material">
    <p><b>COURSE MATERIAL</b></p>               
        <div class="materialss">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Upload Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="course-mat">
                    @foreach($coursematerials as $coursematerial)
                    <tr>
                        <td>{{$coursematerial->material_type}}</td>
                        <td>{{$coursematerial->id}}</td>
                        <td>{{$coursematerial->title}}</td>
                        <td>{{$coursematerial->uploadDate}}</td>
                        <td><a href="{{ route('download',$coursematerial->id) }}"><i class="bx bx-download"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            

        </div>                     
</div>
<div class="mImage">
            <img src="{{ asset('assets/images/placeholders/p3.jpg') }}" alt="">
        </div> 
</div>
<br>
<br>

<div class="alinks">
    <p><b>SUBMISSIONS</b></p>
    @foreach($links as $link)
    <div class="alink">
        <div class="desc">
            <p><b>LINK ID {{$link->id}} : {{$link->title}}</b></p>
            <p>{{$link->description}}</p>
        </div>
        <div class="other">
            <p><i class="bx bx-calendar"></i> Uploaded on: {{$link->uploadDate}}</p>
            <p><i class="bx bx-calendar"></i> Due on: {{$link->dueDate}}</p>
            <p><b>Total marks available: {{$link->marks_available}}</b></p>
        </div>

        <button type="button" data-bs-toggle="modal" data-bs-target="#submissionModal-{{$link->id}}">
         <i class="bx bx-upload"></i>
        </button>
        <!-- Modal -->
        <div class="modal fade" id="submissionModal-{{$link->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Submission</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addSubmission" action="{{ route('student.submission.add', ['courseId' => $courseId, 'linkId' => $link->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- <input id="materialId" name="materialId">  -->
                    
                        <div class="mb-3">
                            <label for="title"  class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <input type="file" class="form-control" id="content"  name="content">
                        </div>

                    <br>
                    <br>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Upload</button>
            </div> -->
            </div>
        </div>
        </div>
    </div>
    <br>
    @endforeach
</div>
    




@endsection
