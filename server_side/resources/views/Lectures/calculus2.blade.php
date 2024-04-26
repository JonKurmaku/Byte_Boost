<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculus 2 Course</title>
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
                    <li>Introduction to Calculus 2</li>
                    <li>Week 1: Integration Techniques</li>
                    <li>Week 2: Sequences and Series</li>
                    <li>Week 3: Parametric Equations and Polar Coordinates</li>
                    <li>Week 4: Vector-Valued Functions</li>
                    <li>Week 5: Differential Equations</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Advanced Integration Methods</option>
                    <option>Lecture 2: Techniques in Finding Volume</option>
                    <option>Lecture 3: Convergence Tests for Series</option>
                    <option>Lecture 4: Working with Power Series</option>
                    <option>Lecture 5: Graphing Polar Coordinates</option>
                    <option>Lecture 6: Vector Functions and Space Curves</option>
                    <option>Lecture 7: Solving Simple Differential Equations</option>
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
                        <li>Quiz 1: Advanced Integration Techniques</li>
                        <li>Quiz 2: Analyzing Series and Sequences</li>
                        <li>Quiz 3: Parametric and Polar Curves</li>
                        <li>Quiz 4: Vector Calculus Basics</li>
                        <li>Quiz 5: Fundamentals of Differential Equations</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Integrating Complex Functions</li>
                        <li>Homework 2: Series Convergence and Divergence Problems</li>
                        <li>Homework 3: Plotting and Analyzing Parametric Equations</li>
                        <li>Homework 4: Vector Field Interpretations</li>
                        <li>Homework 5: Modeling with Differential Equations</li>
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
