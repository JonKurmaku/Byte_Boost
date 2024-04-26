<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Structures Course</title>
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
                    <li>Introduction to Data Structures</li>
                    <li>Week 1: Arrays and Linked Lists</li>
                    <li>Week 2: Stacks and Queues</li>
                    <li>Week 3: Trees and Graphs</li>
                    <li>Week 4: Sorting and Searching Algorithms</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Introduction to Data Structures</option>
                    <option>Lecture 2: Implementing Arrays and Linked Lists</option>
                    <option>Lecture 3: Understanding Stacks and Queues</option>
                    <option>Lecture 4: Exploring Trees</option>
                    <option>Lecture 5: Navigating Graphs</option>
                    <option>Lecture 6: Sorting and Searching Techniques</option>
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
                        <li>Quiz 1: Arrays and Their Applications</li>
                        <li>Quiz 2: Linked List Operations</li>
                        <li>Quiz 3: Tree Traversals</li>
                        <li>Quiz 4: Graph Algorithms</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Implement a Dynamic Array</li>
                        <li>Homework 2: Create a Doubly Linked List</li>
                        <li>Homework 3: Design a Binary Search Tree</li>
                        <li>Homework 4: Apply Dijkstra’s Algorithm</li>
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
                <form id="requestForm">
                    <label for="request">Request Final Assessment</label>
                    <button type="submit"></button>
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
