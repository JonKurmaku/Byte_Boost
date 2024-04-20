<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administrator Dashboard</title>
<link rel="stylesheet" href="{{asset('css/DashboardCSS/StudentDash/DashboardStyle.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
@if(auth()->guard('admin')->check())
<div class="navbar">
  <a href="{{url('/admin/dashboard')}}" class="active">Dashboard</a>
  <a href="{{url('/admin/dashboard/activity')}}">User Activity Log</a>
  <a href="{{url('/admin/dashboard/server-logs')}}">Server Log</a>
</div>
<div class="dashboard">
  <div class="sidebar">
    <div class="profile-info">
      <h2><i class="fas fab fa-black-tie"></i>Admin Information</h2>
      <p><i class="fas fa-bullhorn"></i> <strong>Name:</strong>{{ auth()->guard('admin')->user()->username }}</p>
      <p><i class="fas fa-id-card"></i> <strong>Admin ID:</strong>{{auth()->guard('admin')->user()->id}}</p>
    </div>
    <div class="profile-actions">
      <a href="{{ route('admin.logout') }}">Sign Out</a>
    </div>
  </div>

  <div class="main-content">
    <div class="chart" style="display: block;">
		<h3>Remove Student:</h3>
		<select>
			<option value="std1">Jeff Dunham</option>
			<option value="std2">Bob Saget</option>
		</select>
    </div>
  </div>
</div>
@else
<h1 style="color:white"> User session ended </h1>
@endif
<script src="{{asset("js\DashboardsJS\Admin\adminDashboard.js")}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
