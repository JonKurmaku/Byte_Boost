<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Assessment in C Programming</title>
    <link rel="stylesheet" href="{{asset('css/finalCSS/f.css')}}">
</head>
<body>
    <div class="container">
        <h1>C Programming</h1>
        <button id="startAssessmentBtn">Start Assessment</button>
        <form id="assessmentForm" style="display: none;">
            <div id="timer">00:00</div>
            <div class="question">1. Describe how struct pointers are used in C and provide a code example where a struct pointer accesses a member.<input type="text" id="question1" name="question1"></div>
            <div class="question">2. What is recursion in C? Write a recursive function example for calculating factorial.<input type="text" id="question2" name="question2"></div>
            <div class="question">3. Explain the concept of a linked list in C. How do you insert a new node at the beginning?<input type="text" id="question3" name="question3"></div>
            <div class="question">4. Discuss the differences between arrays and pointers in C with examples.<input type="text" id="question4" name="question4"></div>
            <div class="question">5. Define a doubly linked list and demonstrate with C code how to reverse such a list.<input type="text" id="question5" name="question5"></div>
            
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