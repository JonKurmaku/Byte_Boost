<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Design Assessment</title>
    <link rel="stylesheet" href="{{asset('css/finalCSS/f.css')}}">
</head>
<body>
    <div class="container">
        <h1>Digital Design Assessment</h1>
        <button id="startAssessmentBtn">Start Assessment</button>
        <div id="assessmentForm" style="display: none;">
            <div id="timer">00:00</div>
            <div class="question">1. Describe the function of an XOR gate and provide a real-world application where XOR logic might be used.<input type="text" name="question1"></div>
            <div class="question">2. Explain the differences between combinational and sequential logic circuits. Provide an example of each.<input type="text" name="question2"></div>
            <div class="question">3. What is a flip-flop? Discuss how flip-flops are used in creating registers in digital circuits.<input type="text" name="question3"></div>
            <div class="question">4. How do Karnaugh Maps simplify Boolean expressions? Provide a brief example of how to use a Karnaugh Map to simplify a logic function.<input type="text" name="question4"></div>
            <div class="question">5. Describe the process of synthesizing a digital system using VHDL. What are the main steps involved in this process?<input type="text" name="question5"></div>
            
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
