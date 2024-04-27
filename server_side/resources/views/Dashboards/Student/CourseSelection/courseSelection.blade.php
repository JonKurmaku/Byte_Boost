<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Selection</title>
    <link rel="stylesheet" href="{{asset("css/DashboardCSS/StudentDash/courseSelection.css")}}">
    <link rel="stylesheet" href="{{asset("css/DashboardCSS/StudentDash/DashboardStyle.css")}}">
    
</head>
<body>
@if(auth()->guard('student')->check())
    <div class="navbar">
    <div class="navbar">
        <a href="{{url('/student/dashboard')}}"  >Dashboard</a>
        <a href="{{url('/student/dashboard/courseSelection')}}" class="active" >Course Selected</a>
        <a href="{{url('/student/dashboard/grades')}}" >Grades</a>
        <a href="{{url('/student/dashboard/mentorship')}}" >Mentorship Program</a>
        <a href="{{url('/student/dashboard/feedback')}}">Feedback Page</a>
      </div>
<div class="container">
<h2>Course Selection</h2>
  


           <div>
        <h3>Enrolled Courses</h3>
        <table class="enrolled-table">
    <thead>
        <tr>
            <th>Course Name</th>
            <th>Number of Students Enrolled</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($chosenCourses as $course)
        <tr>
            <td>{{ $course->course_name }}</td>
            <td>{{ $course->num_students_chosen }}</td>
            <td>
                
                <p>Edit</p>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


        <h3>All Courses</h3>
<div class="scrollable-table">
    <table class="add-table">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Availability</th>
                <th>Add Courses</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allCourses as $course)
            <tr>
                <td>{{ $course->course_name }}</td>
                <td>
                    @if ($course->num_students_chosen <= $course->max_students)
                        Available
                    @else
                        Not Available
                    @endif
                </td>
                <td>
                <form action="{{ route('student.course.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <button type="submit">Add</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

    </div>
</div>
  
@else
<h1 style="color:white">User session ended</h1>
@endif
</body>
</html>
