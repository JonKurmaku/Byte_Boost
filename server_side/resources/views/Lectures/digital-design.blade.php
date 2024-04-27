<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Design Course</title>
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
                    <li>Introduction to Digital Design</li>
                    <li>Week 1: Basics of Combinatorial Logic</li>
                    <li>Week 2: Sequential Logic and Systems</li>
                    <li>Week 3: CPLD and FPGA Design</li>
                    <li>Week 4: VLSI Design Basics</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Fundamentals of Digital Logic</option>
                    <option>Lecture 2: Combinatorial Circuits</option>
                    <option>Lecture 3: Sequential Circuits</option>
                    <option>Lecture 4: Introduction to CPLD and FPGA</option>
                    <option>Lecture 5: Basics of VLSI Design</option>
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
                        <li>Quiz 1: Digital Logic Design</li>
                        <li>Quiz 2: Sequential Logic Implementation</li>
                        <li>Quiz 3: FPGA Design Techniques</li>
                        <li>Quiz 4: VLSI Design Challenges</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Design a Binary Adder</li>
                        <li>Homework 2: Create a Clock Divider</li>
                        <li>Homework 3: FPGA Project</li>
                        <li>Homework 4: Simple VLSI Layout</li>
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
