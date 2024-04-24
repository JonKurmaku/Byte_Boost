<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Professor Dashboard</title>
<link rel="stylesheet" href="{{asset('css/DashboardCSS/LecturerDash/LecturerDashboardStyle.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
@if(auth()->guard('lecturer')->check())
<div class="navbar">
  <a href="{{url('/lecturer/dashboard')}}" class="active">Dashboard</a>
  <a href="{{url('/lecturer/dashboard/courses')}}">Course Page</a>
  <a href="#">Student List</a>
  <a href="#">Evaluation</a>
  <a href="#">Mentorship</a>
  <a href="{{url('/lecturer/feedback')}}">Feedback Page</a>
</div>
<div class="dashboard">
  <div class="sidebar">
    <div class="profile-info">
      <h2><i class="fas fa-user"></i>Lecturer Information</h2>
      <p><i class="fas fa-coffee"></i> <strong>Name:</strong>{{ auth()->guard('lecturer')->user()->first_name }} {{ auth()->guard('lecturer')->user()->last_name }}</p>
      <p><i class="fas fa-id-card"></i> <strong>Lecturer ID:</strong>{{auth()->guard('lecturer')->user()->id}}</p>
      <p><i class="fas fa fa-institution"></i> <strong>Department:</strong><br>{{auth()->guard('lecturer')->user()->department}}<br></p>
    </div>
    <div class="profile-actions">
      <a id="edit-profile-btn">Edit Profile</a>
      <a href="{{ route('lecturer.logout') }}">Sign Out</a>
    </div>
  </div>

  <div id="edit-profile-modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Edit Profile</h2>
    <form id="edit-profile-form">
      <label for="new-username">New Username:</label>
      <input type="text" id="new-username" name="new-username" required><br>
      <label for="new-password">New Password:</label>
      <input type="password" id="new-password" name="new-password" required>
      <button type="submit">Save Changes</button>
    </form>
  </div>
</div>

  <div class="main-content">
    <div class="chart" style="display: block;">
		<h3>Select Course:</h3>
		<select id="course-select" onchange="displayCourseStudCnt()">
			<option value="course1">Data Mining</option>
			<option value="course2">Artificial Intelligence</option>
			<option value="course3">Parallel Programming</option>
		</select>
		<br><br>
		<b>Number of Students: </b><span id="std-cnt"></span><br>
    </div>
  </div>
</div>
@else
<h1 style="color:white"> User session ended </h1>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js\DashboardsJS\Lecturer\profDashboard.js')}}"></script>
</body>
</html>
