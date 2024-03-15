<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="{{asset('css/LogInFolder/student.css')}}">
    
    <style>
        /* Additional CSS styles specific to this page */
    </style>
</head>
<body>
    <h1>Student Login</h1>
    <form id="student-login-form" method="POST" action="{{  route('student.login.submit') }}">
        @csrf
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <!--
        <label for="student-id">Student ID:</label><br>
        <input type="text" id="student-id" name="student-id"><br>
-->
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login"><br><br> <br>
      <!-- <input type="submit" value="Login"> -->
        <!-- <a href="SignIn.html" id="signup">Haven't you registered yet? Sign up </a> -->
        <p class="message">Have not registered yet? <a href="{{ url('/StudentSignUp')}}" id="signup">Sign up</a></p>
        
    </form>

    <script src="script.js"></script>
    <script>
     
    </script>
</body>
</html>
