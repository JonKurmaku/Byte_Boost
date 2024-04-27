<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software Engineering Course</title>
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
                    <li>Introduction to Software Engineering</li>
                    <li>Week 1: Software Development Life Cycles</li>
                    <li>Week 2: Requirements Engineering</li>
                    <li>Week 3: Design Patterns and Software Architecture</li>
                    <li>Week 4: Testing and Quality Assurance</li>
                    <li>Week 5: Project Management and Maintenance</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Overview of Software Engineering</option>
                    <option>Lecture 2: Exploring SDLC Models</option>
                    <option>Lecture 3: Gathering and Documenting Requirements</option>
                    <option>Lecture 4: Architectural and Design Patterns</option>
                    <option>Lecture 5: Testing Strategies and Quality Assurance</option>
                    <option>Lecture 6: Agile Project Management</option>
                    <option>Lecture 7: Software Maintenance and Evolution</option>
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
                        <li>Quiz 1: Fundamentals of Software Development</li>
                        <li>Quiz 2: Requirements and Specifications</li>
                        <li>Quiz 3: Understanding Design Patterns</li>
                        <li>Quiz 4: Testing and QA Techniques</li>
                        <li>Quiz 5: Managing Software Projects</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Develop a Small Software Prototype</li>
                        <li>Homework 2: Write a Requirements Specification Document</li>
                        <li>Homework 3: Design a System Using UML Diagrams</li>
                        <li>Homework 4: Create Test Cases for a Software Module</li>
                        <li>Homework 5: Draft a Project Plan Using Agile Methodologies</li>
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
