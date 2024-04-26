<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Object-Oriented Programming Course</title>
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
                    <li>Week 1: Fundamentals of OOP - Classes and Objects</li>
                    <li>Week 2: Inheritance and Polymorphism</li>
                    <li>Week 3: Encapsulation and Interfaces</li>
                    <li>Week 4: Design Patterns and Principles</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Introduction to OOP</option>
                    <option>Lecture 2: Working with Classes and Objects</option>
                    <option>Lecture 3: Implementing Inheritance</option>
                    <option>Lecture 4: Polymorphism in Action</option>
                    <option>Lecture 5: Encapsulation Techniques</option>
                    <option>Lecture 6: Interface Design</option>
                    <option>Lecture 7: Understanding Design Patterns</option>
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
                        <li>Quiz 1: Classes and Objects</li>
                        <li>Quiz 2: Inheritance Concepts</li>
                        <li>Quiz 3: Understanding Polymorphism</li>
                        <li>Quiz 4: Design Patterns and Principles</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Implement a Class Hierarchy</li>
                        <li>Homework 2: Design a Polymorphic System</li>
                        <li>Homework 3: Encapsulation in a Software Module</li>
                        <li>Homework 4: Apply a Design Pattern in a Small Project</li>
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
