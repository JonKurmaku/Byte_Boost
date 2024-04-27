<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentorship Page</title>
    <link rel="stylesheet" href="{{asset('css/DashboardCSS/StudentDash/DashboardStyle.css')}}">
    <link rel="stylesheet" href="{{asset('css/DashboardCSS/StudentDash/studentMentorship.css')}}">
</head>
<body>
<div class="navbar">
        <a href="{{url('/student/dashboard')}}"  >Dashboard</a>
        <a href="{{url('/student/dashboard/courseSelection')}}" >Course Selected</a>
        <a href="{{url('/student/dashboard/grades')}}" >Grades</a>
        <a href="{{url('/student/dashboard/mentorship')}}" class="active">Mentorship Program</a>
        <a href="{{url('/student/dashboard/feedback')}}">Feedback Page</a>
      </div>


        <div class="main-content">
            <table id="coursesTable">
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
    @foreach($courses as $course)
    <tr>
        <td>{{ $course->course_name }}</td>
        <td><button onclick="applyMentorship({{ $course->id }}, {{ $studentId }})">Apply for a mentor</button></td>
    </tr>
    @endforeach
</tbody>

            </table>
        </div>
    </div>
    <script src="{{asset('js/DashboardsJS/Student/studentMentorship.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
