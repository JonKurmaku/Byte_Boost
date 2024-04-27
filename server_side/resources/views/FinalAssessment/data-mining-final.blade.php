<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mining Assessment</title>
    <link rel="stylesheet" href="{{asset('css/finalCSS/f.css')}}">
</head>
<body>
    <div class="container">
        <h1>Data Mining Assessment</h1>
        <button id="startAssessmentBtn">Start Assessment</button>
        <form id="assessmentForm" style="display: none;">
            <div id="timer">00:00</div>
            <div class="question">1. Explain what a decision tree is and describe its use in classification problems. Provide an example of a decision tree for a dataset with attributes A and B.<input type="text" id="question1" name="question1"></div>
            <div class="question">2. Describe the K-means clustering algorithm and give an example of how it can be used to segment customer data into three clusters.<input type="text" id="question2" name="question2"></div>
            <div class="question">3. What is the Apriori algorithm? Discuss how it is used to generate association rules in a market basket analysis.<input type="text" id="question3" name="question3"></div>
            <div class="question">4. Explain the concept of support vector machines (SVM). How are they used in pattern recognition?<input type="text" id="question4" name="question4"></div>
            <div class="question">5. What are artificial neural networks (ANNs)? Give an example of how ANNs can be used for image recognition.<input type="text" id="question5" name="question5"></div>
            
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