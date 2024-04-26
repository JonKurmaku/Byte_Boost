<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C Programming Course</title>
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
                    <li>Introduction to C Programming</li>
                    <li>Week 1: Basics of C - Data Types, Variables, and Input/Output</li>
                    <li>Week 2: Control Structures - Conditional Statements and Loops</li>
                    <li>Week 3: Functions and Recursion</li>
                    <li>Week 4: Pointers and Dynamic Memory Allocation</li>
                    
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Introduction to C</option>
                    <option>Lecture 2: Working with Data Types and Variables</option>
                    <option>Lecture 3: Implementing Control Structures</option>
                    <option>Lecture 4: Creating Functions</option>
                    <option>Lecture 5: Understanding Recursion</option>
                    <option>Lecture 6: Mastering Pointers</option>
                    <option>Lecture 7: Using Structs and Files in C</option>
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
                        <li>Quiz 1: Basics of C Programming</li>
                        <li>Quiz 2: Control Structures</li>
                        <li>Quiz 3: Functions and Pointers</li>
                        <li>Quiz 4: Advanced Topics in C</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Implement a Calculator in C</li>
                        <li>Homework 2: Conditional Statements and Loops Exercises</li>
                        <li>Homework 3: Pointers and Dynamic Memory</li>
                        <li>Homework 4: File Operations with Structs</li>
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
