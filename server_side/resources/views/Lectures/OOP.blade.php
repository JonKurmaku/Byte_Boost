<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Object-Oriented Programming</title>
    <link rel="stylesheet" href="{{asset('css/Lectures/web.css')}}">
</head>
<body>
@if(auth()->guard('student')->check())
    <p>{{$student->username}}
    <br>
    <button onclick="window.location.href='/student/dashboard'">Back</button>
    <div class="container">
        <div class="course-info">
            <h1 class="title">Course Information</h1>
            <div class="section course-syllabus">
                <h2>Course Syllabus</h2>
                <ul>
                    <li>Introduction to Object-Oriented Programming</li>
                    <li>Week 1: Understanding Classes and Objects</li>
                    <li>Week 2: Principles of Inheritance and Polymorphism</li>
                    <li>Week 3: Interfaces and Abstract Classes</li>
                    <li>Week 4: Exception Handling and File I/O</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Introduction to OOP</option>
                    <option>Lecture 2: Classes and Objects</option>
                    <option>Lecture 3: Inheritance</option>
                    <option>Lecture 4: Polymorphism</option>
                    <option>Lecture 5: Interfaces and Abstract Classes</option>
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
                        <li>Quiz 1: Understanding Classes</li>
                        <li>Quiz 2: Working with Inheritance</li>
                        <li>Quiz 3: Implementing Interfaces</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Create a Class Diagram</li>
                        <li>Homework 2: Develop a Simple Inheritance Hierarchy</li>
                        <li>Homework 3: Interface Implementation</li>
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
            <div class="section">
                <form id="requestForm">
                    <label for="request">Request Final Assessment</label>
                    <button type="submit"></button>
                </form>
            </div>
        </div>
    </div>
@else
<h1 style="color:white"> User session ended </h1>
@endif
    <script src="{{asset('js/Lectures/web.js')}}"></script>
</body>
</html>
