<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentorship Page</title>
    <link rel="stylesheet" href="mentorship.css">
</head>
<body>
    <div class="navbar">
        <a href="#" class="active">Dashboard</a>
        <a href="#">Courses Selected</a>
        <a href="#">Grades</a>
        <a href="#">Mentorship Program</a>
        <a href="#">Feedback Page</a>
    </div>

    <div class="dashboard">
        <div class="sidebar">
            <div class="profile-info">
                <h2><i class="fas fa-user"></i> Student Information</h2>
                <p><i class="fas fa-user-graduate"></i> <strong>Name:</strong> John Doe</p>
                <p><i class="fas fa-id-card"></i> <strong>Student ID:</strong> 123456</p>
                <p><i class="fas fa-graduation-cap"></i> <strong>Program:</strong> Computer Science</p>
            </div>
            <div class="profile-actions">
                <a href="#">Edit Profile</a>
                <a href="#">Sign Out</a>
            </div>
        </div>
        <div class="main-content">
            <table id="coursesTable">
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Web Development</td>
                        <td><button onclick="applyMentorship('Web Development')">Apply for a mentor</button></td>
                    </tr>
                    <tr>
                        <td>Software Engineering</td>
                        <td><button onclick="applyMentorship('Data Science')">Apply for a mentor</button></td>
                    </tr>
                    <tr>
                        <td>Machine Learning</td>
                        <td><button onclick="applyMentorship('Machine Learning')">Apply for a mentor</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="mentorship.js"></script>
</body>
</html>
