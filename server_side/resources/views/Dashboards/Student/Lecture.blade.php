<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #1a1a1a; 
            color: #fff; 
        }
        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
        }
        .course-info {
            flex: 0 0 300px; 
            background: #2c3e50; 
            padding: 20px;
           
            border-radius: 8px;
            margin-right: 20px;
        }
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .section {
            background: #fff;
            flex: 1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            color: #333;
            margin-right: 20px;
        }
        .section:last-child {
            margin-right: 0;
        }
        .title, .self-assessment-title {
           
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            background: transparent;
            border: 2px solid #ffffff; 
        }
        .self-assessment-title {
            
           background-color:  #2c3e50;
            border: 2px solid #fff; 
            margin-top: 10px;
            margin-bottom: 20px;
        }
        button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            margin-top: 10px;
        }
        button:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }
        ul, ol {
            list-style-type: none;
            padding: 0;
        }
        li {
            background: #ecf0f1;
            margin-bottom: 10px;
            padding: 10px;
            border-left: 5px solid #3498db;
        }
        form {
            margin-top: 20px;
        }
        label, select, input {
            display: block;
            width: 100%;
            margin-top: 10px;
        }
        input[type="text"], input[type="file"], select {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #bdc3c7;
        }
       
        .course-syllabus {
            margin-bottom: 40px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="course-info">
            <h1 class="title">Course Information</h1>
            <div class="section course-syllabus">
                <h2>Course Syllabus</h2>
                <ul>
                    <li>Introduction to the Course</li>
                    <li>Week 1: Basics of HTML</li>
                    <li>Week 2: Introduction to CSS</li>
                    <li>Week 3: Basics of JavaScript</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lecture</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Introduction</option>
                    <option>Lecture 2: HTML Basics</option>
                    <option>Lecture 3: HTML Forms</option>
                    <!-- Add more lectures -->
                </select>
            </div>
        </div>
        <div class="main-content">
            <div class="self-assessment-title">
                <h2>Self Assessment</h2>
            </div>
            <div class="row"> <!-- Horizontal layout for quizzes and homework -->
                <div class="section">
                    <h2>Quizzes</h2>
                    <ol>
                        <li>Quiz 1: HTML Basics</li>
                        <li>Quiz 2: CSS Fundamentals</li>
                        <li>Quiz 3: JavaScript Introduction</li>
                        <!-- Additional quizzes -->
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Build a Simple HTML Page</li>
                        <li>Homework 2: Style Your Page with CSS</li>
                        <li>Homework 3: Add Interactive Elements with JavaScript</li>
                        <!-- Additional homework -->
                    </ol>
                </div>
            </div>
            <div class="section">
                <h2>Submit Assignments</h2>
                <form id="assignmentForm">
                    <label for="assignmentName">Assignment Name:</label>
                    <input type="text" id="assignmentName" name="assignmentName" required>
                    
                    <label for="assignmentFile">Upload File:</label>
                    <input type="file" id="assignmentFile" name="assignmentFile" required>
                    
                    <button type="submit">Submit Assignment</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('assignmentForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevents traditional submission
            var assignmentName = document.getElementById('assignmentName').value;
            alert('Assignment "' + assignmentName + '" submitted successfully!');
        });
    </script>
</body>
</html>
