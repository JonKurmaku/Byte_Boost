<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Activity Log</title>
<link rel="stylesheet" href="DashboardCSS/LecturerDash/LecturerDashboardStyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
@if(auth()->guard('admin')->check())
<div class="navbar">
  <a href="{{url('/admin/dashboard')}}" >Dashboard</a>
  <a href="{{url('/admin/dashboard/activity')}}" class="active">User Activity Log</a>
  <a href="{{url('/admin/dashboard/server-logs')}}">Server Log</a>
</div>
<div class="dashboard">
  <div class="sidebar">
    <div class="profile-info">
      <h2><i class="fas fab fa-black-tie"></i>Admin Information</h2>
      <p><i class="fas fa-bullhorn"></i> <strong>Name:</strong>{{ auth()->guard('admin')->user()->first_name }} {{ auth()->guard('admin')->user()->last_name }}</p>
      <p><i class="fas fa-id-card"></i> <strong>Admin ID:</strong>{{auth()->guard('admin')->user()->id}}</p>
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
		<code>
			<p>
				Mar 29 19:08:05 - Admin Logged In<br>
				Mar 29 19:09:00 - Student Accessed Courses
			</p>
		</code>
    </div>
  </div>
</div>
@else
<h1 style="color:white"> User session ended </h1>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>