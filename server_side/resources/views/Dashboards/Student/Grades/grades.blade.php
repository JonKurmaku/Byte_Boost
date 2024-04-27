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

<h2>Passed Courses vs Selected Courses</h2>

<canvas id="courseChart" width="400" height="200" style="color: '#ffffffb7';"></canvas>
@else
<h1 style="color:white"> User session ended </h1>
@endif
<script>
    var passedCourses = [85, 70, 95, 60, 80]; 
    var selectedCourses = ["Course 1", "Course 2", "Course 3", "Course 4", "Course 5"]; 

    var ctx = document.getElementById('courseChart').getContext('2d');
    var courseChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: selectedCourses, 
            datasets: [{
                label: 'Passed Course Percentage',
                data: passedCourses, 
                backgroundColor: 'rgba(54, 162, 235, 0.5)', 
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Passed Course Percentage (%)',
                        fontColor: '#ffffffb7'
                    }
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Selected Course Name',
                        fontColor: '#ffffffb7'
                    }
                }]
            }
        }
    });
</script>

</body>
</html>
