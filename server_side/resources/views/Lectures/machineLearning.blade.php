<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machine Learning Course</title>
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
                    <li>Introduction to Machine Learning</li>
                    <li>Week 1: Supervised Learning - Regression and Classification</li>
                    <li>Week 2: Unsupervised Learning - Clustering and Dimensionality Reduction</li>
                    <li>Week 3: Neural Networks and Deep Learning</li>
                    <li>Week 4: Reinforcement Learning</li>
                    <li>Week 5: Best Practices in Machine Learning: Evaluation and Bias-Variance Tradeoff</li>
                </ul>
            </div>
            <div class="section lecture-videos">
                <h2>Lectures</h2>
                <select id="lectureDropdown">
                    <option>Lecture 1: Basics of Machine Learning</option>
                    <option>Lecture 2: Linear Regression and Logistic Regression</option>
                    <option>Lecture 3: Decision Trees and SVMs</option>
                    <option>Lecture 4: K-Means Clustering and PCA</option>
                    <option>Lecture 5: Introduction to Neural Networks</option>
                    <option>Lecture 6: Advanced Deep Learning Models</option>
                    <option>Lecture 7: Introduction to Reinforcement Learning</option>
                    <option>Lecture 8: Model Evaluation Techniques</option>
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
                        <li>Quiz 1: Linear Models and Their Complexity</li>
                        <li>Quiz 2: Ensemble Methods and Their Application</li>
                        <li>Quiz 3: Neural Networks and Computational Graphs</li>
                        <li>Quiz 4: Policy Gradient Methods in RL</li>
                        <li>Quiz 5: Evaluating Model Performance and Overfitting</li>
                    </ol>
                </div>
                <div class="section">
                    <h2>Homework Assignments</h2>
                    <ol>
                        <li>Homework 1: Implement Linear Regression from Scratch</li>
                        <li>Homework 2: Cluster Analysis on Dataset</li>
                        <li>Homework 3: Build and Train a Basic Neural Network</li>
                        <li>Homework 4: Design a Reinforcement Learning Agent</li>
                        <li>Homework 5: Cross-validation on Various Models</li>
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
