<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="{{asset('css/LogInFolder/student.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
  
</head>
<body>
    <h1>Student Login</h1>
    <form id="student-login-form" onsubmit="validateForm(event)" method="POST" action="{{  route('student.login.submit') }}">
        @csrf
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <span style="color:red;" id="err-username"></span>
        <br>
        <br>
        <!--
        <label for="student-id">Student ID:</label><br>
        <input type="text" id="student-id" name="student-id"><br>
-->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <span style="color:red;" id="err-password"></span>
        <br><br>
        <input type="submit" value="Login"><br><br> <br>
      <!-- <input type="submit" value="Login"> -->
        <!-- <a href="SignIn.html" id="signup">Haven't you registered yet? Sign up </a> -->
        <p class="message"><i class="fa-regular fa-registered"></i> Have not registered yet? <a href="{{ url('/StudentSignUp')}}" id="signup"> Sign up</a></p>
        <p class="message"><i class="fa-regular fa-user"></i> Not a student?<a href="{{ url('/')}}" id="back"> Go back</a></p>  
    </form>

    <script src="{{asset('js/LogInValidation/studentVal.js')}}"></script>
</body>
</html>
