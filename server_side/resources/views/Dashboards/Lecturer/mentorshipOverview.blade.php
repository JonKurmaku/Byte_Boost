<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Dashboard</title>
    <link rel="stylesheet" href="{{asset('css/DashboardCSS/LecturerDash/LecturerMentorship.css')}}">
</head>
<body>
<div class="navbar">
  <a href="{{url('/lecturer/dashboard')}}" >Dashboard</a>
  <a href="{{url('/lecturer/dashboard/courses')}}">Course Page</a>
  <a href="{{url('/lecturer/dashboard/studentlist')}}" >Student List</a>
  <a href="{{url('/lecturer/dashboard/evaluation')}}">Evaluation</a>
  <a href="{{url('/lecturer/dashboard/mentorship')}}"  class="active">Mentorship Overview</a>
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
    <table id="coursesTable">
        <thead>
            <tr>
            <th>Course ID</th>
            <th>Course Name</th>
                <th>Student IDs</th>
                <th>Process Request</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mentorshipApplications as $application)
                <tr id="{{ $application->course_id }}{{ $application->student_id }}">
                    <td>{{ $application->course_id }}</td>
                    <td>{{ $application->course_name }}</td>
                    <td>{{ $application->student_id }}</td>
                    <td><button onclick="processMentor('{{$application->course_id}}','{{$application->course_name }}','{{$application->student_id}}')">Process</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="overlay" id="overlay"></div>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <form id="popupForm">
                <label >Accept</label>
                <input type="radio" name="status" value="accept" required> Accept
                <label >Refuse</label>
                <input type="radio" name="status" value="refuse" required> Refuse
            <button type="submit">Submit</button>
        </form>
    </div>
</div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js/DashboardsJS/Lecturer/lecturerMentorship.js')}}"></script>
</body>
</html>
