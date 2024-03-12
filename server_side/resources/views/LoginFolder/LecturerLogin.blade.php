<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Login</title>
    <link rel="stylesheet" href="{{asset('css/LogInFolder/lecturer.css')}}">
    <style>
        /* Additional CSS styles specific to this page */
    </style>
</head>
<body>
    <h1>Lecturer Login</h1>
    <form id="lecturer-login-form">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="employee-id">Employee ID:</label><br>
        <input type="text" id="employee-id" name="employee-id"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login"><br><br> <br>
         <!-- <a href="SignIn.html" id="signup">Haven't you registered yet? Sign up </a> -->
         <p class="message">Have not registered yet? <a href="{{ url('/LecturerSignUp')}}" id="signup">Sign up</a></p>
     
    </form>

    <script src="script.js"></script>
    <script>
        // JavaScript specific to this page
    </script>
</body>
</html>
