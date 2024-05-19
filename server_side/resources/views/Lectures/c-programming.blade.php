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
    <p>Student :<strong>{{$student->username}}</strong></p>
    <br>
    <button onclick="window.location.href='/student/dashboard'">Back</button>
    <div class="container">
        <div class="course-info">
            <h1 class="title">Course Information</h1>
            <div class="section course-syllabus">
                <h2>Course Syllabus</h2>
                <ul>
                    <li>Introduction to C Programming</li>
                    <li>Week 1: Data Types, Variables, and Input/Output</li>
                    <li>Week 2: Control Structures (If, For, While)</li>
                    <li>Week 3: Functions and Arrays</li>
                    <li>Week 4: Pointers and Dynamic Memory Allocation</li>
                    <li>Week 5: Structs and File Handling</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Introduction to C</option>
                    <option>Lecture 2: Working with Data Types and Variables</option>
                    <option>Lecture 3: Control Structures</option>
                    <option>Lecture 4: Functions and Modular Programming</option>
                    <option>Lecture 5: Arrays and Strings</option>
                    <option>Lecture 6: Introduction to Pointers</option>
                    <option>Lecture 7: Memory Management in C</option>
                    <option>Lecture 8: Working with Structures</option>
                    <option>Lecture 9: File Operations in C</option>
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
                        <li>Quiz 1: Basic Syntax and Operators</li>
                        <li>Quiz 2: Control Structures and Loops</li>
                        <li>Quiz 3: Functions and Arrays</li>
                        <li>Quiz 4: Pointers and Memory Management</li>
                        <li>Quiz 5: Structures and File Handling</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Write a Program to Calculate Student Grades</li>
                        <li>Homework 2: Create a Simple Calculator using Functions</li>
                        <li>Homework 3: Implement an Array-Based Queue</li>
                        <li>Homework 4: Develop a Dynamic String Manipulation Library</li>
                        <li>Homework 5: Create a Record Management System using Files</li>
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
                <form id="takeForm" method="GET" action="{{ route('final_assessment.render', ['slug' => $course->slug]) }}"> 
                    <button name="take" type="submit">Take Final Assessment</button>
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
