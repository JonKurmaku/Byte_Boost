<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Course Information</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="{{asset("css/DashboardCSS/StudentDash/DashboardStyle.css")}}">
<link rel="stylesheet" href="{{asset("css/DashboardCSS/StudentDash/grades.css")}}">
</head>

<body>
@if(auth()->guard('student')->check())
<div class="navbar">
        <a href="{{url('/student/dashboard')}}"  >Dashboard</a>
        <a href="{{url('/student/dashboard/courseSelection')}}" >Course Selected</a>
        <a href="{{url('/student/dashboard/grades')}}" class="active" >Grades</a>
        <a href="{{url('/student/dashboard/mentorship')}}" >Mentorship Program</a>
        <a href="{{url('/student/dashboard/feedback')}}">Feedback Page</a>
      </div>
  

      <h2>Course Information</h2>

      <table>
    <thead>
        <tr>
            <th>Course Name</th>
            <th>Lecturer Name</th>
            <th>Grades</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($coursesData as $course)
    <tr>
        <td>{{ $course->course_name }}</td>
        <td>{{ $course->lecturer_name}}</td>
        <td>
            @php
                $assessment = $finalAssesmentData->firstWhere('course_id', $course->id);
            @endphp

            @if ($assessment)
                {{ $assessment->grade }}
            @else
                No Grade
            @endif
        </td>
    </tr>
    @endforeach
</tbody>

</table>

<h2>Successful Course Completion</h2>
<div id="graph"></div>

@else
<h1 style="color:white"> User session ended </h1>
@endif
<script src="https://d3js.org/d3.v7.min.js"></script>
<script>
var data = {!! json_encode($coursesData) !!}; 
var selectedCourses = [];

data.forEach(function(course) {
    var passed = 0;
    var assessment = {!! json_encode($finalAssesmentData->first()) !!};
    if (assessment && assessment.course_id === course.id) {
        passed = assessment.grade ? 1 : 0;
    }
    selectedCourses.push({ selected: course.id, passed: passed });
});

function drawGraph(data) {
    var graphContainer = document.getElementById('graph');
    graphContainer.innerHTML = ''; 

    var width = 400;
    var height = 300;
    var margin = { top: 20, right: 20, bottom: 30, left: 50 };
    var graphWidth = width - margin.left - margin.right;
    var graphHeight = height - margin.top - margin.bottom;

    var svg = d3.create("svg")
        .attr("width", width)
        .attr("height", height);
    
    graphContainer.appendChild(svg.node());

    var xScale = d3.scaleLinear()
        .domain([0, d3.max(data, function(d) { return d.selected; })])
        .range([0, graphWidth]);

    var yScale = d3.scaleLinear()
        .domain([0, d3.max(data, function(d) { return d.passed; })])
        .range([graphHeight, 0]);

    var xAxis = d3.axisBottom(xScale);
    var yAxis = d3.axisLeft(yScale);

    svg.append('g')
        .attr('transform', 'translate(' + margin.left + ',' + (height - margin.bottom) + ')')
        .call(xAxis);

    svg.append('g')
        .attr('transform', 'translate(' + margin.left + ',' + margin.top + ')')
        .call(yAxis);

    var line = d3.line()
        .x(function(d) { return xScale(d.selected); })
        .y(function(d) { return yScale(d.passed); });

    svg.append('path')
        .datum(data)
        .attr('fill', 'none')
        .attr('stroke', 'steelblue')
        .attr('stroke-width', 1.5)
        .attr('transform', 'translate(' + margin.left + ',' + margin.top + ')')
        .attr('d', line);
}

        drawGraph(selectedCourses);
</script>
<script src-="{{asset("js/DashboardJS/Student/grades.js")}}"></script>
</body>
</html>
