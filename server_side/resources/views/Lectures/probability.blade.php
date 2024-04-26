<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fundamentals of Probability Course</title>
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
                    <li>Introduction to Probability</li>
                    <li>Week 1: Basic Probability Concepts</li>
                    <li>Week 2: Random Variables and Probability Distributions</li>
                    <li>Week 3: Special Distributions and Expectations</li>
                    <li>Week 4: Moments, Variance, and Transformations</li>
                    <li>Week 5: Convergence and Limit Theorems</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Probability Fundamentals</option>
                    <option>Lecture 2: Introduction to Random Variables</option>
                    <option>Lecture 3: Discrete Distributions</option>
                    <option>Lecture 4: Continuous Distributions and Density Functions</option>
                    <option>Lecture 5: Generating Functions and Characteristic Functions</option>
                    <option>Lecture 6: The Central Limit Theorem and Applications</option>
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
                        <li>Quiz 1: Understanding Basic Probability</li>
                        <li>Quiz 2: Properties of Random Variables</li>
                        <li>Quiz 3: Working with Discrete Distributions</li>
                        <li>Quiz 4: Working with Continuous Distributions</li>
                        <li>Quiz 5: Limit Theorems and Their Importance</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Calculating Probabilities in Simple Experiments</li>
                        <li>Homework 2: Analyzing Binomial Distributions</li>
                        <li>Homework 3: Applications of Normal Distributions</li>
                        <li>Homework 4: Using Poisson Processes</li>
                        <li>Homework 5: Statistical Inference with Probability</li>
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
