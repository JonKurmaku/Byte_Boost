<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="{{ asset('css/SignUpFolder/SignInStudent.css')}}"> 
</head>
<body>
    <div class="container">
    <h2>Student Registration</h2>
    <form id="student-registration-form" method="POST" action="{{route('student.store')}}">
        @csrf
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>

        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="password_confirmation" required><br>

        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name"><br>

        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name"><br>

        <label for="gender">Gender:</label><br>
        <select id="gender" name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br>

        <label for="dob">Date of Birth:</label><br>
        <input type="date" id="dob" name="dob"><br><br>

        <label for="country">Country:</label><br>
        <input type="text" id="country" name="country"><br>

        <label for="interests">Interests:</label><br>
        <textarea id="interests" name="interests" rows="4" cols="50"></textarea><br>

       <!-- <label for="avatar">Avatar:</label><br>
        <input type="file" id="avatar" name="avatar" accept="image/*"><br>-->
        <input type="submit" value="Register">
    </form>
</div>
</body>
</html>
