<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
        
            <h1>Welcome to the Lecturer Dashboard, {{ auth()->guard('lecturer')->user()->username }}</h1>
    <p>This is a placeholder for your dashboard. You can customize it as per your requirements.</p>
    <ul>
        <li><a href="#">View Courses</a></li>
        <li><a href="#">Grade Assignments</a></li>
        <li><a href="#">Manage Students</a></li>
    </ul>
</body>
</html>
