<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Technologies and Programming</title>
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
                    <li>Introduction to the Course</li>
                    <li>Week 1: Basics of HTML - Elements, Attributes, and Document Structure</li>
                    <li>Week 2: Introduction to CSS - Selectors, Properties, and Box Model</li>
                    <li>Week 3: Basics of JavaScript - Syntax, Operators, and DOM Manipulations</li>
                    <li>Week 4: Advanced Topics - Responsive Design with CSS, Introduction to JavaScript Libraries (jQuery)</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Introduction to Web Development</option>
                    <option>Lecture 2: HTML Basics</option>
                    <option>Lecture 3: HTML Forms and Tables</option>
                    <option>Lecture 4: CSS for Layouts</option>
                    <option>Lecture 5: JavaScript Control Structures</option>
                    <option>Lecture 6: Event Handling in JavaScript</option>
                    <option>Lecture 7: Advanced CSS Techniques</option>
                    <option>Lecture 8: Exploring jQuery Basics</option>
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
                        <li>Quiz 1: HTML Basics</li>
                        <li>Quiz 2: CSS Fundamentals</li>
                        <li>Quiz 3: JavaScript Basics</li>
                        <li>Quiz 4: Advanced Web Techniques</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Build a Simple HTML Page</li>
                        <li>Homework 2: Style Your Page with CSS</li>
                        <li>Homework 3: Add Interactive Elements with JavaScript</li>
                        <li>Homework 4: Create a Responsive Layout with Media Queries</li>
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
