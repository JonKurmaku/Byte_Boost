<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programming Paradigms Assessment</title>
    <link rel="stylesheet" href="{{asset('css/finalCSS/f.css')}}">
</head>
<body>
    <div class="container">
        <h1>Programming Paradigms Assessment</h1>
        <button id="startAssessmentBtn">Start Assessment</button>
        <form id="assessmentForm" style="display: none;">
            <div id="timer">00:00</div>
            <div class="question">1. Describe procedural programming and give an example of a language that primarily uses this paradigm.<input type="text" id="question1" name="question1"></div>
            <div class="question">2. What are the key features of object-oriented programming? Provide an example of a language that exemplifies this paradigm and a brief example of its implementation.<input type="text" id="question2" name="question2"></div>
            <div class="question">3. Explain the concepts of functional programming. What benefits does it provide over procedural programming? Give an example.<input type="text"  id="question3" name="question3"></div>
            <div class="question">4. Discuss the logical programming paradigm and name a programming language used for this paradigm. Provide a simple code example.<input type="text" id="question4" name="question4"></div>
            <div class="question">5. Compare and contrast the object-oriented and functional programming paradigms. What are the strengths and weaknesses of each?<input type="text" id="question5" name="question5"></div>
            
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
