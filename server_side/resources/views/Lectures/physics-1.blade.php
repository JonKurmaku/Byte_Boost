<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Physics 1 Course</title>
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
                    <li>Introduction to Physics</li>
                    <li>Week 1: Mechanics - Motion in One Dimension</li>
                    <li>Week 2: Mechanics - Newton's Laws of Motion</li>
                    <li>Week 3: Conservation of Energy and Momentum</li>
                    <li>Week 4: Thermodynamics and Heat Transfer</li>
                    <li>Week 5: Waves and Sound</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Kinematics in One Dimension</option>
                    <option>Lecture 2: Vectors and Projectile Motion</option>
                    <option>Lecture 3: Newton's Laws and Applications</option>
                    <option>Lecture 4: Work, Energy, and Power</option>
                    <option>Lecture 5: Conservation Laws</option>
                    <option>Lecture 6: Fundamentals of Thermodynamics</option>
                    <option>Lecture 7: Introduction to Waves and Sound</option>
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
                        <li>Quiz 1: Motion in One Dimension</li>
                        <li>Quiz 2: Newton's Laws in Practice</li>
                        <li>Quiz 3: Energy and Work</li>
                        <li>Quiz 4: Principles of Thermodynamics</li>
                        <li>Quiz 5: Understanding Waves and Sound</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Calculating Kinematics</li>
                        <li>Homework 2: Newton's Laws Case Studies</li>
                        <li>Homework 3: Energy Conservation Problems</li>
                        <li>Homework 4: Heat Transfer Experiments</li>
                        <li>Homework 5: Wave Characteristics and Properties</li>
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
