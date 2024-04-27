<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artificial Intelligence Assessment</title>
    <link rel="stylesheet" href="{{asset('css/finalCSS/f.css')}}">
</head>
<body>
    <div class="container">
        <h1>Artificial Intelligence Assessment</h1>
        <button id="startAssessmentBtn">Start Assessment</button>
        <form id="assessmentForm" style="display: none;">
            <div id="timer">00:00</div>
            <div class="question">1. Explain the concept of 'Heuristic Search' in AI and provide an example where it can be applied.<input type="text" id="question1" name="question1"></div>
            <div class="question">2. Describe the role of Natural Language Processing (NLP) in AI. What are the challenges of implementing NLP in AI systems?<input type="text" id="question2" name="question2"></div>
            <div class="question">3. Discuss the integration of machine learning models in robotics. Provide an example of a robot utilizing these models.<input type="text" id="question3" name="question3"></div>
            <div class="question">4. What are genetic algorithms? Give an example of how they are used in optimization problems.<input type="text" id="question4" name="question4"></div>
            <div class="question">5. What are the ethical implications of AI in decision-making processes? Discuss a specific scenario in detail.<input type="text" id="question5" name="question5"></div>
            
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
