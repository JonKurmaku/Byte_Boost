<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login</title>
    <link rel="stylesheet" href="{{asset('css/LogInFolder/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        
        <p class="message"><i class="fa-solid fa-building-columns"></i> Not a admin?<a href="{{ url('/')}}" id="back"> Go back</a></p>

    </form>
    

    <script src="{{asset('js/LogInValidation/adminVal.js')}}"></script>
    
</body>
</html>
