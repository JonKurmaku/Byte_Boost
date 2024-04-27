<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Probability Fundamentals Assessment</title>
    <link rel="stylesheet" href="{{asset('css/finalCSS/f.css')}}">
</head>
<body>
    <div class="container">
        <h1>Probability Fundamentals Assessment</h1>
        <button id="startAssessmentBtn">Start Assessment</button>
        <form id="assessmentForm" style="display: none;">
            <div id="timer">00:00</div>
            <div class="question">1. What is conditional probability? Provide an example where conditional probability might be used.<input type="text" id="question1" name="question1"></div>
            <div class="question">2. Explain the Law of Total Probability and give an example of how it can be applied.<input type="text" id="question2" name="question2"></div>
            <div class="question">3. How does one calculate permutations? Give an example calculation for finding the number of permutations of 5 items taken 3 at a time.<input type="text" id="question3" name="question3"></div>
            <div class="question">4. What is a binomial probability distribution? Describe its properties and provide an example scenario where it could be used.<input type="text" id="question4" name="question4"></div>
            <div class="question">5. Define and explain the difference between independent and dependent events in probability.<input type="text" id="question5" name="question5"></div>
            
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
