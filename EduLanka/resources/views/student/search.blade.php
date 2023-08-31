@extends('layouts.studentLayout')

@section('content')

@if(isset($courses) && $courses->count() > 0)
    <div class="search-results">
        <h2>Search Results</h2>
        <ul>
            @foreach($courses as $course)
                <li>
                    <p>Subject: {{ $course->subject }}</p>
                    <p>Level: {{ $course->level }}</p>
                </li>
            @endforeach
        </ul>
    </div>
@else
    <p>No results found.</p>
@endif

@endsection