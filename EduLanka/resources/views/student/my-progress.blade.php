@extends('layouts.studentLayout')
@section('content')
<p><b>My Progress</b></p>
<div class="pro">
    <div class="chart-container">
      <h3><b>Average Per Course</b></h3>
      <br>
        <canvas id="myChart"></canvas>
    </div>
    <div class="chart-container">
      <h3><b>Grade Distribution</b></h3>
      <br>
        <canvas id="myChart2"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
var courseLabels = [];
var courseAverages = [];
var gradesCount = @json($gradesCount); // Convert the PHP array to a JavaScript object

@foreach($courses as $course)
    courseLabels.push("{{$course->level}} - {{$course->subject}}");
    @if(isset($courseAverages[$course->id]))
        courseAverages.push({{ $courseAverages[$course->id] }});
    @else
        courseAverages.push(0); // Handle the case where course average is not available
    @endif
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

const ctx2 = document.getElementById('myChart2');
new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ['A', 'B', 'C', 'D','E','F'], 
        datasets: [{
            label: 'Grades',
            data: [gradesCount['A'], gradesCount['B'], gradesCount['C'], gradesCount['D'], gradesCount['E'], gradesCount['F']],
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

@endsection
