<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Structures Assessment</title>
    <link rel="stylesheet" href="{{asset('css/finalCSS/f.css')}}">
</head>
<body>
    <div class="container">
        <h1>Data Structures Assessment</h1>
        <button id="startAssessmentBtn">Start Assessment</button>
        <form id="assessmentForm" style="display: none;">
            <div id="timer">00:00</div>
            <div class="question">1. What is a binary tree? Provide an example of how it can be used in sorting and searching algorithms.<input type="text" id="question1" name="question1"></div>
            <div class="question">2. Explain the difference between a stack and a queue. Provide a real-world application for each.<input type="text" id="question2" name="question2"></div>
            <div class="question">3. Describe what a hash table (dictionary) is and how it handles collisions.<input type="text" id="question3" name="question3"></div>
            <div class="question">4. Discuss the concept of a graph and explain two ways it can be represented in memory.<input type="text" id="question4" name="question4"></div>
            <div class="question">5. What are balanced trees and why are they important in database indexing?<input type="text" id="question5" name="question5"></div>
            
            <button type="submit">Submit</button>
</form>
    </div>
    <script>
    let _studentId = {{ $student->id }};
    let _courseId = {{ $course->id }};
    </script>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('js/final/final.js')}}"></script>
</body>
</html>
