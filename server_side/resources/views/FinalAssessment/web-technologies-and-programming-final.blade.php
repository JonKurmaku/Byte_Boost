<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Assessment</title>
    <link rel="stylesheet" href="{{asset('css/finalCSS/f.css')}}">
</head>
<body>
    <div class="container">
        <h1>Final Assessment</h1>
        <p>{{$student->id}}</p>
        <p>{{$course->id}}</p>
        <button id="startAssessmentBtn">Start Assessment</button>
        <form id="assessmentForm" style="display: none;">
            <div id="timer">00:00</div>
            <div class="question">1.Describe the purpose of the <!DOCTYPE> declaration in an HTML document. What happens if it is omitted?<input type="text" id="question1" name="question1"></div>
            <div class="question">2.Explain the difference between box-sizing: content-box; and box-sizing: border-box;. How does each property affect element sizing in CSS?<input type="text" id="question2" name="question2"></div>
            <div class="question">3.What is a closure in JavaScript? Provide an example where a closure might be used and explain why it is beneficial in that context<input type="text" id="question3" name="question3"></div>
            <div class="question">4.Define responsive web design and explain how CSS media queries are used.<input type="text" id="question4" name="question4"></div>
            <div class="question">5.Explain the difference between HTTP GET and POST methods. In what scenarios might each be used?<input type="text" id="question5" name="question5"></div>
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
