<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artificial Intelligence Course</title>
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
                    <li>Introduction to Artificial Intelligence</li>
                    <li>Week 1: History and Foundations of AI</li>
                    <li>Week 2: Search Algorithms and Game Theory</li>
                    <li>Week 3: Knowledge Representation and Reasoning</li>
                    <li>Week 4: Machine Learning in AI</li>
                    <li>Week 5: Neural Networks and Deep Learning</li>
                    <li>Week 6: Natural Language Processing</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: What is AI?</option>
                    <option>Lecture 2: Intelligent Agents and Environments</option>
                    <option>Lecture 3: Optimization and Search Strategies</option>
                    <option>Lecture 4: Logic and Planning</option>
                    <option>Lecture 5: Introduction to Machine Learning</option>
                    <option>Lecture 6: Advanced Topics in Neural Networks</option>
                    <option>Lecture 7: Applications of NLP</option>
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
                        <li>Quiz 1: Basics of AI and Intelligent Agents</li>
                        <li>Quiz 2: Search Algorithms and Their Applications</li>
                        <li>Quiz 3: Logical Reasoning and AI Planning</li>
                        <li>Quiz 4: Fundamentals of Machine Learning</li>
                        <li>Quiz 5: Deep Learning Concepts</li>
                        <li>Quiz 6: Natural Language Processing Techniques</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Implement a Simple Search Algorithm</li>
                        <li>Homework 2: Develop a Tic-Tac-Toe AI using Minimax</li>
                        <li>Homework 3: Create a Knowledge-Based System</li>
                        <li>Homework 4: Train a Small Neural Network</li>
                        <li>Homework 5: Sentiment Analysis with NLP</li>
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
