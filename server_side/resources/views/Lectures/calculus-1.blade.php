<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculus 1 Course</title>
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
                    <li>Introduction to Calculus</li>
                    <li>Week 1: Limits and Continuity</li>
                    <li>Week 2: Differentiation</li>
                    <li>Week 3: Applications of Differentiation</li>
                    <li>Week 4: Integration</li>
                    <li>Week 5: Applications of Integration</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Understanding Limits</option>
                    <option>Lecture 2: Techniques of Differentiation</option>
                    <option>Lecture 3: Maxima, Minima, and Optimization</option>
                    <option>Lecture 4: Fundamentals of Integration</option>
                    <option>Lecture 5: Integration Techniques</option>
                    <option>Lecture 6: Area and Volume Applications</option>
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
                        <li>Quiz 1: Understanding Limits and Continuity</li>
                        <li>Quiz 2: Differentiation Rules</li>
                        <li>Quiz 3: Applications of Derivatives</li>
                        <li>Quiz 4: Introduction to Integration</li>
                        <li>Quiz 5: Applications of Definite Integrals</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Calculate Limits using Different Approaches</li>
                        <li>Homework 2: Solve Differentiation Problems</li>
                        <li>Homework 3: Graphing Functions using Derivatives</li>
                        <li>Homework 4: Evaluate Integrals</li>
                        <li>Homework 5: Solve Area under Curve Problems</li>
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
