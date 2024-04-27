<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operating Systems Assessment</title>
    <link rel="stylesheet" href="{{asset('css/finalCSS/f.css')}}">
</head>
<body>
    <div class="container">
        <h1>Operating Systems Assessment</h1>
        <button id="startAssessmentBtn">Start Assessment</button>
        <form id="assessmentForm" style="display: none;">
            <div id="timer">00:00</div>
            <div class="question">1. Explain the concept of a process in an operating system. How does the OS manage multiple processes?<input type="text" id="question1" name="question1"></div>
            <div class="question">2. Describe how virtual memory works and its benefits to modern computing.<input type="text" id="question2" name="question2"></div>
            <div class="question">3. Explain the workings of the Shortest Job First (SJF) scheduling algorithm and discuss its potential drawbacks in a multi-user environment.<input type="text" id="question3" name="question3"></div>
            <div class="question">4. What are system calls in an operating system? Provide an example of a system call in Linux and explain what it does.<input type="text" id="question4" name="question4"></div>
            <div class="question">5. Discuss the architecture of distributed operating systems and the challenges associated with their design and implementation.<input type="text" id="question5" name="question5"></div>
            
            <button type="submit">Submit</button>
        </div>
</form>

    <script>
    let _studentId = {{ $student->id }};
    let _courseId = {{ $course->id }};
    </script>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('js/final/final.js')}}"></script>
</body>
</html>