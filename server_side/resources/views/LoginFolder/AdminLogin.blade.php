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
    <form id="admin-login-form" onsubmit="validateForm()" method="POST" action="{{  route('admin.login.submit') }}">
    @csrf
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>

    <script src="script.js"></script>
    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            if (username === "" || password === "") {
                alert("Please enter both username and password.");
                return false;
            }
           
            alert("You logged in successfully!");
            return true;
        }
    </script>
</body>
</html>
