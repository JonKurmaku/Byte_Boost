<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Evaluation Page</title>
    <link rel="stylesheet" href="{{asset('css/DashboardCSS/LecturerDash/LecturerDashboardStyle.css')}}">
    <link rel="stylesheet" href="{{asset('css/DashboardCSS/LecturerDash/LecturerEvaluation.css')}}">
</head>
<body>
    
<body>
@if(auth()->guard('lecturer')->check())
<div class="navbar">
  <a href="{{url('/lecturer/dashboard')}}" >Dashboard</a>
  <a href="{{url('/lecturer/dashboard/courses')}}">Course Page</a>
  <a href="{{url('/lecturer/dashboard/studentlist')}}">Student List</a>
  <a href="{{url('/lecturer/dashboard/evaluation')}}"  class="active">Evaluation</a>
  <a href="{{url('/lecturer/dashboard/mentorship')}}">Mentorship Overview</a>
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
<table id="evaluationTable">
    <thead>
        <tr>
            <th>Course Name</th>
            <th>Final Assessment</th>
            <th>Evaluation Requests</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lecturerCourses as $course)
        <tr>
            <td>{{ $course->course_name }}</td>
            <td><button onclick="viewAssessment({{ $course->id }})">View</button></td>
            <td><button onclick="openPopup({{ $course->id }})">Evaluate</button></td>
        </tr>
        @endforeach
    </tbody>
</table>


   <div id="popup-form">
   <span class="close" onclick="closePopupForm()">&times;</span>
    <div id="popup-form-content" class="popup-form-content">
        <form id="evaluationForm">
        <label>
            <input type="radio" name="evaluation" value="Passed"> Passed
        </label>
        <label>
            <input type="radio" name="evaluation" value="Failed"> Failed
        </label>
        <br><br>
        <input type="submit" value="Submit">
    </form>
  </div>
</div>



   <div id="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <table id="studentTable">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Submission</th>
                    <th>Evaluate</th>
                </tr>
            </thead>
            <tbody id="studentList"></tbody>
        </table>
    </div>
</div>



@else
<h1 style="color:white"> User session ended </h1>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js/DashboardsJS/Lecturer/evaluationPage.js')}}"></script>
</body>
</html>
