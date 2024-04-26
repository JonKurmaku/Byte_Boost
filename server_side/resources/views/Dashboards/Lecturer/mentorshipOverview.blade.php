<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Dashboard</title>
    <link rel="stylesheet" href="LMentorship.css">
</head>
<body>
    <div class="navbar">
        <a href="#" class="active">Dashboard</a>
        <a href="#">Courses</a>
        <a href="#">Student List</a>
        <a href="#">Evaluation</a>
        <a href="#">Mentorship Overview</a>
        <a href="#">Feedback</a>
    </div>

    <div class="dashboard">
        <div class="sidebar">
            <div class="profile-info">
                <h2><i class="fas fa-user"></i> Lecturer Information</h2>
                <p><i class="fas fa-user-graduate"></i> <strong>Name:</strong> Jane Smith</p>
                <p><i class="fas fa-id-card"></i> <strong>Employee ID:</strong> 987654</p>
                <p><i class="fas fa-chalkboard-teacher"></i> <strong>Department:</strong> Computer Science</p>
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
                        <th>Students Applied</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Web Development</td>
                        <td><a href="#" onclick="showStudents('Web Development')">5 Students</a></td>
                    </tr>
                    <tr>
                        <td>Data Science</td>
                        <td><a href="#" onclick="showStudents('Data Science')">3 Students</a></td>
                    </tr>
                    <tr>
                        <td>Machine Learning</td>
                        <td><a href="#" onclick="showStudents('Machine Learning')">8 Students</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="LMentorship.js"></script>
</body>
</html>
