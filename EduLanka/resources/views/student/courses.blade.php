@extends('layouts.studentLayout')

@section('content')
<p><b>MY COURSES</b></p> 
<div class="student-courses">
    <div class="my-courses">
        @foreach($courses as $course)
        <a href="{{route('viewCourse', $course->id)}}">
            <div class="acourse">
                <div class="card" style="width: 18rem; background-color: {{ '#' . substr(md5(rand()), 0, 6) }}; color:white;">
                    <?php
                    // Get a list of image files in the images folder
                    $imageFiles = glob('assets/images/placeholders/*.jpg'); // Adjust the path and file extension as needed
                    // Select a random image from the list
                    $randomImage = $imageFiles[array_rand($imageFiles)];
                    ?>
                    <img class="card-img-top" src="{{ asset($randomImage) }}" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">{{$course->level}} {{$course->subject}}</p>
                    </div>
                </div>
            </div>

        </a>
        @endforeach  
       
        
    </div>
    <div class="all-courses">
        <p><b>All Courses for your level</b></p>
        <p>Select to enroll</p>
        <div class="enroll">
            @foreach($allCourses as $allCourse)
            <div>
                <p>{{$allCourse -> subject}}</p>
            </div>
            <div>
                <label class="switch">
                    <input type="checkbox" data-course-id="{{ $allCourse->id }}" {{ in_array($allCourse->id, $courses->pluck('id')->toArray()) ? 'checked' : '' }}>
                    <div class="slider"></div>
                    <div class="slider-card">
                        <div class="slider-card-face slider-card-front"></div>
                        <div class="slider-card-face slider-card-back"></div>
                    </div>
                </label>
            </div>
            
            @endforeach

        </div>      
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const courseId = this.dataset.courseId;
                const isChecked = this.checked;

                if (isChecked) {
                    this.disabled = true;
                }
                

                fetch(`/enroll/${courseId}`, {
                    method: isChecked ? 'POST' : 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    // Handle response data if needed
                    location.reload();
                })
                .catch(error => {
                    // Handle error if needed
                });
            });
        });



        
    });
</script>
@endsection