<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administrator Dashboard</title>
<link rel="stylesheet" href="{{asset('css/DashboardCSS/AdminDash/UserActivity.css')}}">
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
    <h2>Students</h2>
    <table>
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Program</th>
                <th colspan="2" >Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $record)
            <tr>
                <td>{{ $record->id}}</td>
                <td>{{ $record->username}}</td>
                <td>{{ $record->first_name}} {{$record->last_name}}</td>
                <td>{{ $record->email}}</td>
                <td>{{ $record->program}}</td>
                <td><button onclick="showEditStudentForm({{$record->id}})">Edit</button></td>
                <td><button onclick="deleteStudentRecord({{$record->id}})">Delete</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Lecturers</h2>
    <table>
        <thead>
            <tr>
                <th>Lecturer ID</th>
                <th>Username</th>
                <th>FullName</th>
                <th>Email</th>
                <th>Department</th>
                <th>Specialization</th>
                <th colspan="2" >Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lecturers as $record)
            <tr>
                <td>{{ $record->id}}</td>
                <td>{{ $record->username}}</td>
                <td>{{ $record->first_name}} {{$record->last_name}}</td>
                <td>{{ $record->email}}</td>
                <td>{{ $record->department}}</td>
                <td>{{ $record->specialization}}</td>
                <td><button onclick="showEditLecturerForm({{$record->id}})">Edit</button></td>
                <td><button onclick="deleteLecturerRecord({{$record->id}})">Delete</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Courses</h2>
    <table>
        <thead>
            <tr>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Lecturer ID</th>
                <th>Students Enrolled</th>
                <th>Maximum Enrollments</th>
                <th colspan="2" >Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $record)
            <tr>
                <td>{{ $record->id}}</td>
                <td>{{ $record->course_name}}</td>
                <td>{{$record->lecturer_id}}</td>
                <td>{{ $record->num_students_chosen}}</td>
                <td>{{ $record->max_students}}</td>
                <td><button onclick="showEditCourseForm({{$record->id}})">Edit</button></td>
                <td><button onclick="deleteCourseRecord({{$record->id}})">Delete</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>

<div id="editStudentFormContainer" class="popup-form-container" style="display: none;">
    <div id="editStudentForm" class="popup-form-content">
        <span class="close" onclick="closeEditStudentForm()">&times;</span>
        <form id="editStudentRecordForm">
            <label for="studentFirstame">Firstname:</label>
            <input type="text" id="studentFirstname" name="studentFirstname">
            <label for="studentLastname">Lastname:</label>
            <input type="text" id="studentLastname" name="studentLastname">
            <label for="studentEmail">Email:</label>
            <input type="email" id="studentEmail" name="studentEmail">
            <label for="studentProgram">Program:</label>
            <input type="text" id="studentProgram" name="studentProgram">
            <input type="submit" value="Save Changes">
        </form>
    </div>
</div>

<div id="editLecturerFormContainer" class="popup-form-container" style="display: none;">
    <div id="editLecturerForm" class="popup-form-content">
        <span class="close" onclick="closeEditLecturerForm()">&times;</span>
        <form id="editLecturerRecordForm">
            <label for="lecturerFirstname">Firstname:</label>
            <input type="text" id="lecturerFirstname" name="lecturerFirstname">
            <label for="lecturerLastname">Lastname:</label>
            <input type="text" id="lecturerLastname" name="lecturerLastname">
            <label for="lecturerEmail">Email:</label>
            <input type="email" id="lecturerEmail" name="lecturerEmail">
            <label for="lecturerDepartment">Department:</label>
            <input type="text" id="lecturerDepartment" name="lecturerDepartment">
            <label for="lecturerSpecialization">Specialization:</label>
            <input type="text" id="lecturerSpecialization" name="lecturerSpecialization">
            <input type="submit" value="Save Changes">
        </form>
    </div>
</div>


<div id="editCourseFormContainer" class="popup-form-container" style="display: none;">
    <div id="editCourseForm" class="popup-form-content">
        <span class="close" onclick="closeEditCourseForm()">&times;</span>
        <form id="editCourseRecordForm">
            <label for="courseName">Course Name:</label>
            <input type="text" id="courseName" name="courseName">
            <label for="courseMaxnumber">Maximal Quotas:</label>
            <input type="number" id="courseMaxnumber" name="courseMaxnumber">
            <input type="submit" value="Save Changes">
        </form>
    </div>
</div>


</div>

</div>
@else
<h1 style="color:white"> User session ended </h1>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset("js\DashboardsJS\Admin\adminDashboard.js")}}"></script>
</body>
</html>
