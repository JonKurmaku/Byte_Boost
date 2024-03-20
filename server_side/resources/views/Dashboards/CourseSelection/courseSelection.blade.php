<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Selection</title>
    <link rel="stylesheet" href="{{asset("css/DashboardCSS/StudentDash/courseSelection.css")}}">
    <link rel="stylesheet" href="{{asset("css/DashboardCSS/StudentDash/DashboardStyle.css")}}">
    
</head>
<body>
@if(auth()->guard('student')->check())
    <div class="navbar">
        <a href="{{url('/student/dashboard')}}" class="active">Dashboard</a>
        <a href="{{url('/student/dashboard/courseSelection')}}">Course Overview</a>
        <a href="#">Grades</a>
        <a href="#">Mentorship Program</a>
        <a href="#">Feedback Page</a>
      </div>
<div class="container">
    
        <h2>Course Selection</h2>
       <div>
        <h3>Enrolled Courses</h3>
        <table class="enrolled-table">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Number of Students Enrolled</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Course A</td>
                    <td>50</td>
                    <td><button class="button">Edit</button></td>
                </tr>
                <tr>
                    <td>Course B</td>
                    <td>30</td>
                    <td><button class="button">Edit</button></td>
                </tr>
            </tbody>
        </table>

        <h3>All Courses</h3>
        <div class="scrollable-table">
            <table class="add-table">
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Availability</th>
                        <th>Add Courses</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Course C</td>
                        <td>Available</td>
                        <td><button class="button">+</button></td>
                    </tr>
                    <tr>
                        <td>Course D</td>
                        <td>Available</td>
                        <td><button class="button">+</button></td>
                    </tr>
                    <tr>
                        <td>Course C</td>
                        <td>Available</td>
                        <td><button class="button">+</button></td>
                    </tr>
                    <tr>
                        <td>Course D</td>
                        <td>Available</td>
                        <td><button class="button">+</button></td>
                    </tr>
                    <tr>
                        <td>Course C</td>
                        <td>Available</td>
                        <td><button class="button">+</button></td>
                    </tr>
                    <tr>
                        <td>Course D</td>
                        <td>Available</td>
                        <td><button class="button">+</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
  
@else
<h1 style="color:white">User session ended</h1>
@endif
</body>
</html>
