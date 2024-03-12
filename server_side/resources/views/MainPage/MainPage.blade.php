<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Main Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        video {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1000;
        }
        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 1;
            color: #fff;
        }
        h1 {
            color: #fff;
            font-size: 3em;
        }
        .options {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }
        .options a {
            display: inline-block;
            padding: 30px 30px;
            text-decoration: none;
            color: #fff;
            background-color: #1036b3;
            border-radius: 5px;
            transition: background-color 0.3s;
              }
              /* .glow {
  color: #fff;
  text-align: center;
  animation: glow 1s ease-in-out infinite alternate;
}

@keyframes glow {
  from {
    text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #00ff00, 0 0 40px #00ff00, 0 0 50px #00ff00, 0 0 60px #00ff00, 0 0 70px #00ff00;
  }
  
  to {
    text-shadow: 0 0 20px #fff, 0 0 30px #00ff00, 0 0 40px #00ff00, 0 0 50px #00ff00, 0 0 60px #00ff00, 0 0 70px #00ff00, 0 0 80px #00ff00;
  }
}

@-webkit-keyframes glow {
  from {
    text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #00ff00, 0 0 40px #00ff00, 0 0 50px #00ff00, 0 0 60px #00ff00, 0 0 70px #00ff00;
  }
  
  to {
    text-shadow: 0 0 20px #fff, 0 0 30px #00ff00, 0 0 40px #00ff00, 0 0 50px #00ff00, 0 0 60px #00ff00, 0 0 70px #00ff00, 0 0 80px #00ff00;
  }
}

@-moz-keyframes glow {
  from {
    text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #00ff00, 0 0 40px #00ff00, 0 0 50px #00ff00, 0 0 60px #00ff00, 0 0 70px #00ff00;
  }
  
  to {
    text-shadow: 0 0 20px #fff, 0 0 30px #00ff00, 0 0 40px #00ff00, 0 0 50px #00ff00, 0 0 60px #00ff00, 0 0 70px #00ff00, 0 0 80px #00ff00;
  }
} */


        .options a:hover {
            background-color: #32ad59;
        } 
    </style>
</head>
<body>
    <video autoplay muted loop>
        <source src="{{asset('videos/circuit.mp4')}}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="content">
        <h1>Welcome to ByteBoost! <i class="fa-solid fa-computer"></i></h1>
        <div class="options">
            <a class="glow"  href="{{ url('/StudentLogin') }}">Student</a>
            <a class="glow" href="{{ url('/LecturerLogin') }}">Lecturer</a>
            <a class="glow" href="{{ url('/AdminLogin') }}">Administrator</a>
        </div>
    </div>
</body>
</html>
