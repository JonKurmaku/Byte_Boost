<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Registration</title>
    <link rel="stylesheet" href="{{ asset('css/SignUpFolder/SignInLecturer.css') }}">
</head>
<body>
    <div class="container">
        <h2>Lecturer Registration</h2>
        <form id="lecturer-registration-form" onsubmit="validateForm()" method="POST" action="{{ route('lecturer.store') }}">
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

            <label for="qualification">Qualification:</label><br>
            <input type="text" id="qualification" name="qualification"><br>

            <label for="specialization">Specialization:</label><br>
            <input type="text" id="specialization" name="specialization"><br>

            <label for="experience">Experience (in years):</label><br>
            <input type="number" id="experience" name="experience" min="0"><br>

            <input type="submit" value="Register">
        </form>
    </div>
<script src="{{asset('js/SignUpJS/lecturerSignUp.js')}}"></script>
<script>
    function validateForm() {
        var username = document.getElementById("username").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        var experience = document.getElementById("experience").value;
        

            if (username === "" || email === "" || password === "" || confirmPassword === "" || experience === "") {
                alert("All fields are required.");
                return false;
            }

        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }   
        if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/.test(password)) {
        alert("Password must contain at least one lowercase letter, one uppercase letter, one digit, and be at least 8 characters long.");
        return false;
    }
        alert("You signed up successfully!Click OK to continue!");
        return true;
    }
</script>
</body>
</html>
