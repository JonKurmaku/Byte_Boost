<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard</title>
<link rel="stylesheet" href="{{asset('css/DashboardCSS/StudentDash/DashboardStyle.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
@if(auth()->guard('student')->check())
<div class="navbar">
<a href="{{url('/student/dashboard')}}" class="active">Dashboard</a>
        <a href="{{url('/student/dashboard/courseSelection')}}" >Course Overview</a>
        <a href="{{url('/student/dashboard/grades')}}">Grades</a>
        <a href="#">Mentorship Program</a>
        <a href="{{url('/student/dashboard/feedback')}}">Feedback Page</a>
      </div>
<div class="dashboard">
  <div class="sidebar">
    <div class="profile-info">
      <h2><i class="fas fa-user"></i> Student Information</h2>
      <p><i class="fas fa-user-graduate"></i> <strong>Name:</strong>{{ auth()->guard('student')->user()->first_name }} {{ auth()->guard('student')->user()->last_name }}</p>
      <p><i class="fas fa-id-card"></i> <strong>Student ID:</strong> {{ auth()->guard('student')->user()->id }} </p>
      <p><i class="fas fa-graduation-cap"></i> <strong>Program:</strong> {{ auth()->guard('student')->user()->program }}</p>
    </div>
    <div class="profile-actions">
      <a id="edit-profile-btn" >Edit Profile</a>
      <a href="{{ route('student.logout') }}">Sign Out</a>
    </div>
  </div>

  <div id="edit-profile-modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Edit Profile</h2>
    <form id="edit-profile-form">
      <label for="new-username">New Username:</label>
      <input type="text" id="new-username" name="new-username" required>
      <label for="new-password">New Password:</label>
      <input type="password" id="new-password" name="new-password" required>
      <button type="submit">Save Changes</button>
    </form>
  </div>
</div>

<div class="main-content">
    @foreach ($chosenCourses as $course)
    <div class="chart">
        <h3><i class="fas fa-chart-pie"></i>{{ $course->course_name }}</h3>
        <canvas id="{{ $course->slug }}Chart" width="200" height="200"></canvas>
        <a href="{{ route('lecture.show', $course->slug) }}" class="btn">Go to Lecture Page <i class="fa-solid fa-arrow-right"></i></a>
    </div>
    @endforeach
</div>



@else
<h1 style="color:white"> User session ended </h1>
@endif
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{asset('js\DashboardsJS\Student\stdDashboard.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
