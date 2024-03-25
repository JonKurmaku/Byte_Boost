<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Login</title>
    <link rel="stylesheet" href="{{ asset('css/LogInFolder/lecturer.css') }}">
    <style>
        
    </style>
</head>
<body>
    <h1>Lecturer Login</h1>
    <form id="lecturer-login-form" onsubmit="validateForm(event)" method="POST" action="{{  route('lecturer.login.submit') }}">
        @csrf 
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <span style="color:red;" id="err-username"></span>
        <br>
        <!--  <label for="employee-id">Employee ID:</label><br>
        <input type="text" id="employee-id" name="employee-id" required><br>
-->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <span style="color:red;" id="err-password"></span>
        <br><br>
        <input type="submit" value="Login"><br><br>
        <p class="message">Haven't registered yet? <a href="{{ url('/LecturerSignUp') }}" id="signup">Sign up</a></p>
    </form>
    <script src="{{asset('js/LogInValidation/lecturerVal.js')}}"></script>
</body>
</html>
