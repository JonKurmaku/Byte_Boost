<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculus 2 & 3 Assessment</title>
    <link rel="stylesheet" href="{{asset('css/finalCSS/f.css')}}">
</head>
<body>
    <div class="container">
        <h1>Calculus II Assessment</h1>
        <button id="startAssessmentBtn">Start Assessment</button>
        <form id="assessmentForm" style="display: none;">
            <div id="timer">00:00</div>
            <div class="question">1. Compute the line integral ∮(x^2 + y^2) ds, where C is the curve defined by the intersection of the cylinder x^2 + y^2 = 1 and the plane z = 2.<input type="text" id="question1" name="question1"></div>
            <div class="question">2. Find the divergence of the vector field F(x, y, z) = (x^2, y^2, z^2).<input type="text" id="question2" name="question2"></div>
            <div class="question">3. Evaluate the triple integral ∭(x^2 + y^2 + z^2) dV over the region bounded by the planes x = 0, y = 0, z = 0, and x + y + z = 1.<input type="text" id="question3" name="question3"></div>
            <div class="question">4. Determine the convergence or divergence of the series Σ(n^2 / (n^3 + 1)).<input type="text" id="question4" name="question4"></div>
            <div class="question">5. Compute the curl of the vector field F(x, y, z) = (x^2 + y^2, y^2 + z^2, z^2 + x^2).<input type="text" id="question5" name="question5"></div>
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