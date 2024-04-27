<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operating Systems Course</title>
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
                    <li>Introduction to Operating Systems</li>
                    <li>Week 1: Processes and Threads</li>
                    <li>Week 2: Scheduling and Synchronization</li>
                    <li>Week 3: Memory Management</li>
                    <li>Week 4: File Systems and Storage</li>
                    <li>Week 5: Security and Protection</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Overview of Operating Systems</option>
                    <option>Lecture 2: Processes and Thread Management</option>
                    <option>Lecture 3: CPU Scheduling Algorithms</option>
                    <option>Lecture 4: Concurrency and Deadlocks</option>
                    <option>Lecture 5: Memory Allocation and Paging</option>
                    <option>Lecture 6: File Systems Architecture</option>
                    <option>Lecture 7: Security Mechanisms in OS</option>
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
                        <li>Quiz 1: Processes and Thread Concepts</li>
                        <li>Quiz 2: Scheduling Techniques</li>
                        <li>Quiz 3: Synchronization and Deadlocks</li>
                        <li>Quiz 4: Memory Management Strategies</li>
                        <li>Quiz 5: File System Operations</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Simulate a Process Scheduler</li>
                        <li>Homework 2: Implement a Mutex Lock</li>
                        <li>Homework 3: Design a Simple Paging System</li>
                        <li>Homework 4: File System Management Project</li>
                        <li>Homework 5: Develop a Basic Security Module for an OS</li>
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
