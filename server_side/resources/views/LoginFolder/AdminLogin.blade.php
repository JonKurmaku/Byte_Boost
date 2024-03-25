<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login</title>
    <link rel="stylesheet" href="{{asset('css/LogInFolder/admin.css')}}">
</head>
<body>
    <h1>Administrator Login</h1>
    <form id="admin-login-form" onsubmit="validateForm(event)" method="POST" action="{{  route('admin.login.submit') }}">
    @csrf
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <span style="color:red;" id="err-username"></span>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <span style="color:red;" id="err-password"></span>
        <br><br>
        <input type="submit" value="Login">
    </form>

    <script src="{{asset('js/LogInValidation/adminVal.js')}}"></script>
    
</body>
</html>
