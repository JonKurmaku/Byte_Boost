<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Physics 1 Assessment</title>
    <link rel="stylesheet" href="{{asset('css/finalCSS/f.css')}}">
</head>
<body>
    <div class="container">
        <h1>Physics 1 Assessment</h1>
        <button id="startAssessmentBtn">Start Assessment</button>
        <form id="assessmentForm" style="display: none;">
            <div id="timer">00:00</div>
            <div class="question">1. A car accelerates from rest to 60 km/h in 7 seconds. Calculate its average acceleration.<input type="text" id="question1" name="question1"></div>
            <div class="question">2. Calculate the gravitational force between two 5 kg masses that are 0.2 meters apart.<input type="text" id="question2" name="question2"></div>
            <div class="question">3. A projectile is launched at an angle of 45 degrees with an initial velocity of 30 m/s. Calculate the maximum height it achieves.<input type="text" id="question3" name="question3"></div>
            <div class="question">4. If 150 Joules of work are needed to push a crate 10 meters across a floor with a frictional force of 10 N, calculate the efficiency of the process.<input type="text" id="question4" name="question4"></div>
            <div class="question">5. An ideal gas is compressed in a piston from a volume of 3 liters to 1 liter at a constant pressure of 100 kPa. Calculate the work done on the gas.<input type="text" id="question5" name="question5"></div>
            
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
