<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP Concepts Assessment</title>
    <link rel="stylesheet" href="{{asset('css/finalCSS/f.css')}}">
</head>
<body>
    <div class="container">
        <h1>Object-Oriented Programming Assessment</h1>
        <button id="startAssessmentBtn">Start Assessment</button>
        <form id="assessmentForm" style="display: none;">
            <div id="timer">00:00</div>
            <div class="question">1. Explain what a class is in OOP and how it differs from an instance of a class. Provide an example in any OOP language.<input type="text" id="question1" name="question1"></div>
            <div class="question">2. Describe inheritance and its benefits in OOP. Give an example using Java or C.<input type="text" id="question2" name="question2"></div>
            <div class="question">3. What is polymorphism in OOP? Provide code examples of method overloading and method overriding.<input type="text" id="question3" name="question3"></div>
            <div class="question">4. Explain how exceptions are handled in Java. Provide a simple example of try-catch block.<input type="text" id="question4" name="question4"></div>
            <div class="question">5. Discuss the concept of generics in Java and why they are used. Include a brief code example illustrating their use.<input type="text" id="question5" name="question5"></div>
            
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