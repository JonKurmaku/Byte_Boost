<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mining Course</title>
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
                    <li>Introduction to Data Mining</li>
                    <li>Week 1: Data Understanding and Preparation</li>
                    <li>Week 2: Data Warehousing and OLAP</li>
                    <li>Week 3: Mining Frequent Patterns and Associations</li>
                    <li>Week 4: Classification and Prediction</li>
                    <li>Week 5: Cluster Analysis</li>
                    <li>Week 6: Mining Complex Types of Data</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Overview of Data Mining</option>
                    <option>Lecture 2: Data Preprocessing Techniques</option>
                    <option>Lecture 3: Introduction to Data Warehousing</option>
                    <option>Lecture 4: Algorithms for Association Mining</option>
                    <option>Lecture 5: Classification Methods</option>
                    <option>Lecture 6: Techniques in Cluster Analysis</option>
                    <option>Lecture 7: Advanced Data Mining Topics</option>
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
                        <li>Quiz 1: Principles of Data Preparation</li>
                        <li>Quiz 2: Data Warehousing Fundamentals</li>
                        <li>Quiz 3: Frequent Pattern and Association Mining</li>
                        <li>Quiz 4: Classification Accuracy and Techniques</li>
                        <li>Quiz 5: Clustering Algorithms and Their Applications</li>
                        <li>Quiz 6: Special Topics in Data Mining</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Data Cleaning and Transformation Tasks</li>
                        <li>Homework 2: Implementing an OLAP Cube</li>
                        <li>Homework 3: Association Rule Mining with Apriori Algorithm</li>
                        <li>Homework 4: Building and Evaluating a Classifier</li>
                        <li>Homework 5: Conducting a Clustering Analysis</li>
                        <li>Homework 6: Mining Text and Web Data</li>
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
