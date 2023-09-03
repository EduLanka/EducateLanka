@extends('layouts.studentLayout')
@section('content')
<p><b>My Progress</b></p>
<!DOCTYPE html>
<html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>
<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>
var xValues = ["Graded", "Not Graded", "Due"];
var yValues = [30, 58, 12];
var barColors = [
  "#FFA500",
  "#0000FF",
  "#FF0000"
];

new Chart("myChart", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Submission Status"
    }
  }
});
</script>

@endsection
