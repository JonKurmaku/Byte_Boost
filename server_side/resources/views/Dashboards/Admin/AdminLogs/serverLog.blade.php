<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Server Log</title>
<link rel="stylesheet" href="{{asset('css/DashboardCSS/StudentDash/DashboardStyle.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
@if(auth()->guard('admin')->check())
<div class="navbar">
  <a href="{{url('/admin/dashboard')}}">Dashboard</a>
  <a href="{{url('/admin/dashboard/activity')}}">User Activity Log</a>
  <a href="{{url('/admin/dashboard/server-logs')}}" class="active" >Server Log</a>
</div>
<div class="dashboard">
  <div class="sidebar">
    <div class="profile-info">
      <h2><i class="fas fab fa-black-tie"></i>Admin Information</h2>
      <p><i class="fas fa-bullhorn"></i> <strong>Name:</strong>{{ auth()->guard('admin')->user()->first_name }} {{ auth()->guard('admin')->user()->last_name }}</p>
      <p><i class="fas fa-id-card"></i> <strong>Admin ID:</strong>{{auth()->guard('admin')->user()->id}}</p>
    </div>
    <div class="profile-actions">
      <a href="{{ route('admin.logout') }}">Sign Out</a>
    </div>
  </div>

  <div class="main-content">
  <table border="1">
        <thead>
            <tr>
                <th>Username</th>
                <th>User Priority</th>
                <th>Request Description</th>
                <th>Request Type</th>
                <th>Request Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($serverLogTable as $record)
            <tr>
                <td>{{ $record->username}}</td>
                <td>{{ $record->user_level}}</td>
                <td>{{ $record->request_description}}</td>
                <td>{{ $record->http_request_type}}</td>
                <td>{{ $record->request_time}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

  </div>
</div>
@else
<h1 style="color:white"> User session ended </h1>
@endif
<script src="{{asset("js\DashboardsJS\Admin\adminDashboard.js")}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
