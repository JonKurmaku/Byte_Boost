<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <link rel="stylesheet" href="{{asset('css/Lectures/web.css')}}">
</head>
<body>
    <div class="container">
        <div class="course-info">
            <h1 class="title">Course Information</h1>
            <div class="section course-syllabus">
                <h2>Course Syllabus</h2>
                <ul>
                    <li>Introduction to the Course</li>
                    <li>Week 1: Variables</li>
                    <li>Week 2: Linked List</li>
                    <li>Week 3: Terminal Access</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lecture</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Introduction</option>
                    <option>Lecture 2: LL & DLL</option>
                    <option>Lecture 3: CMD</option>
                </select>
            </div>
        </div>
        <div class="main-content">
            <div class="self-assessment-title">
                <h2>Self Assessment</h2>
            </div>
            <div class="row"> 
                <div class="section">
                    <h2>Quizzes</h2>
                    <ol>
                        <li>Quiz 1: Intro</li>
                        <li>Quiz 2: C Fundamentals</li>
                        <li>Quiz 3: LinkedList Introduction</li>
                        
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

    <script src="{{asset('js/Lectures/web.js')}}"></script>
</body>
</html>
