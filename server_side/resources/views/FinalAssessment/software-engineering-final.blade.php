<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software Engineering Assessment</title>
    <link rel="stylesheet" href="{{asset('css/finalCSS/f.css')}}">
</head>
<body>
    <div class="container">
        <h1>Software Engineering Assessment</h1>
        <p>{{$student->id}}</p>
        <p>{{$course->id}}</p>
        <button id="startAssessmentBtn">Start Assessment</button>
        <form id="assessmentForm" style="display: none;">
            <div id="timer">00:00</div>
            <div class="question">1. Explain the Waterfall model and its stages in the context of software development.<input type="text" id="question1" name="question1"></div>
            <div class="question">2. Describe the Agile methodology and its advantages over traditional project management approaches.<input type="text" id="question2" name="question2"></div>
            <div class="question">3. What are design patterns in software engineering? Provide an example of a commonly used design pattern.<input type="text" id="question3" name="question3"></div>
            <div class="question">4. Discuss the importance of unit testing and provide an example of a testing framework used in software development.<input type="text" id="question4" name="question4"></div>
            <div class="question">5. Explain the concept of Continuous Integration and its benefits in modern software development practices.<input type="text" id="question5" name="question5"></div>
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