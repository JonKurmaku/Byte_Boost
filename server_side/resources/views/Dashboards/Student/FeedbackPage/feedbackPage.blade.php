<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lecturers Search</title>
<link rel="stylesheet" type="text/css" href="feedbackPage.css">
<link rel="stylesheet" href="{{asset("css/DashboardCSS/StudentDash/feedbackPage.css")}}">
    <link rel="stylesheet" href="{{asset("css/DashboardCSS/StudentDash/DashboardStyle.css")}}">
</head>
<body>
@if(auth()->guard('student')->check())
<div class="navbar">
<a href="{{url('/student/dashboard')}}"  >Dashboard</a>
        <a href="{{url('/student/dashboard/courseSelection')}}" >Course Overview</a>
        <a href="{{url('/student/dashboard/grades')}}" class="active">Grades</a>
        <a href="#">Mentorship Program</a>
        <a href="{{url('/student/dashboard/feedback')}}">Feedback Page</a>
</div>
    
<h2>Lecturers Search</h2>

<div class="dropdown">
  <select id="lecturerSelect" onchange="showPopup()">
    <option value="">Select Lecturer</option>
  </select>
</div>

<div id="popup" class="popup">
  <div class="popup-content">
    <span class="close" onclick="closePopup()">&times;</span>
    <input type="text" id="searchInput" onkeyup="searchLecturers()" placeholder="Search for lecturers...">
    <ul id="lecturerList"></ul>
  </div>
</div>
@else
<h1 style="color:white">User session ended</h1>
@endif
<script src="{{asset('js\DashboardsJS\Student\feedback.js')}}"></script>
</body>
</html>
