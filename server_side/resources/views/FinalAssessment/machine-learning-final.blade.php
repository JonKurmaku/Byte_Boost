<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machine Learning Assessment</title>
    <link rel="stylesheet" href="{{asset('css/finalCSS/f.css')}}">
</head>
<body>
    <div class="container">
        <h1>Machine Learning Assessment</h1>
        <button id="startAssessmentBtn">Start Assessment</button>
        <form id="assessmentForm" style="display: none;">
            <div id="timer">00:00</div>
            <div class="question">1. Explain the difference between supervised and unsupervised learning. Provide an example of a machine learning model for each.<input type="text" id="question1" name="question1"></div>
            <div class="question">2. What is cross-validation in machine learning? Why is it important?<input type="text" id="question2" name="question2"></div>
            <div class="question">3. Describe a neural network architecture for image classification. What are the key components?<input type="text" id="question3" name="question3"></div>
            <div class="question">4. What are the main challenges associated with training deep learning models?<input type="text" id="question4" name="question4"></div>
            <div class="question">5. Explain reinforcement learning. Provide an example scenario where it could be effectively applied.<input type="text" id="question5" name="question5"></div>
            
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
