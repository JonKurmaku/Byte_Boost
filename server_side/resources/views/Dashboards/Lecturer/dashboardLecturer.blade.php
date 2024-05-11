<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Professor Dashboard</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="{{asset('css/DashboardCSS/LecturerDash/LecturerCoursePage.css')}}">
<link rel="stylesheet" href="{{asset('css/DashboardCSS/LecturerDash/LecturerDashboardStyle.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
@if(auth()->guard('lecturer')->check())
<div class="navbar">
  <a href="{{url('/lecturer/dashboard')}}" class="active">Dashboard</a>
  <a href="{{url('/lecturer/dashboard/courses')}}">Course Page</a>
  <a href="{{url('/lecturer/dashboard/studentlist')}}">Student List</a>
  <a href="{{url('/lecturer/dashboard/evaluation')}}">Evaluation</a>
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

<div class="main-content">
  <div id="courses-table">
    <table>
      <thead>
        <tr>
          <th>Course Id</th>
          <th>Course Name</th>
          <th>Number of Students</th>
        </tr>
      </thead>
      <tbody>
        @foreach($lecturerCourses as $course)
        <tr>
          <td>{{ $course->id }}</td>
          <td>{{ $course->course_name }}</td>
          <td>{{ $course->num_students_chosen }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="chart-container" style="max-width: 400px;">
    <canvas id="courseChart" width="300" height="300" style="color: white"></canvas>
  </div>
</div>
@else
<h1 style="color:white"> User session ended </h1>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js\DashboardsJS\Lecturer\profDashboard.js')}}"></script>
<script>
    var courseData = {!! json_encode($lecturerCourses->pluck('num_students_chosen')) !!};
    var courseNames = {!! json_encode($lecturerCourses->pluck('course_name')) !!};

    var ctx = document.getElementById('courseChart').getContext('2d');
    var courseChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: courseNames,
            datasets: [{
                label: 'Number of Students',
                data: courseData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        color: 'white'
                    }
                }
            }
        }
    });
</script>

</body>
</html>
