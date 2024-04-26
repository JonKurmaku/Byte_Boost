<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculus 1 Assessment</title>
    <link rel="stylesheet" href="{{asset('css/finalCSS/f.css')}}">
</head>
<body>
    <div class="container">
        <h1>Calculus I Assessment</h1>
        <button id="startAssessmentBtn">Start Assessment</button>
        <div id="assessmentForm" style="display: none;">
            <div id="timer">00:00</div>
            <div class="question">1. Define the concept of a limit in calculus. Provide an example of a limit as x approaches a number.<input type="text" name="question1"></div>
            <div class="question">2. Explain what a derivative is and show how to find the derivative of the function f(x) = 3x².<input type="text" name="question2"></div>
            <div class="question">3. Solve the differential equation dy/dx = 3x^2 + 5 with initial condition y(0) = 2.<input type="text" name="question3"></div>
            <div class="question">4. Calculate the integral of sin(x) * cos(x) from 0 to π/2.<input type="text" name="question4"></div>
            <div class="question">5. What is the difference between definite and indefinite integrals? Give an example of each.<input type="text" name="question5"></div>
            
            <button type="submit">Submit</button>
        </div>
    </div>

    <script>
    let _studentId = {{ $student->id }};
    let _courseId = {{ $course->id }};
    </script>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('js/final/final.js')}}"></script>
</body>
</html>