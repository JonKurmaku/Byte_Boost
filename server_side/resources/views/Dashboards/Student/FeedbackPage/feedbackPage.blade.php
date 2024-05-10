<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Lecturers Search</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="{{asset("css/DashboardCSS/StudentDash/feedbackPage.css")}}">
<link rel="stylesheet" href="{{asset("css/DashboardCSS/StudentDash/DashboardStyle.css")}}">
</head>
<body>
@if(auth()->guard('student')->check())
<div class="navbar">
        <a href="{{url('/student/dashboard')}}"  >Dashboard</a>
        <a href="{{url('/student/dashboard/courseSelection')}}" >Course Selected</a>
        <a href="{{url('/student/dashboard/grades')}}" >Grades</a>
        <a href="{{url('/student/dashboard/mentorship')}}" >Mentorship Program</a>
        <a href="{{url('/student/dashboard/feedback')}}" class="active">Feedback Page</a>
      </div>
    
<h2>Lecturers Search</h2>

<input type="text" id="searchInput" placeholder="Search for a lecturer...">
<ul id="lecturerList">
</ul>

<div id="popup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <ul id="popupLecturerList"></ul>
    </div>
</div>

<div id="popup-form" class="popup-form" style="display:none;">
    <div class="popup-content">
        <span class="close" onclick="closePopupForm()">&times;</span>
        <h3>Feedback Form</h3>
        
        <form id="rating-form">
            
            <label>Rating</label>
            <div class="star-rating">
    <input type="radio" id="star5" name="rating" value="1">
    <label for="star5"><i class="fas fa-star"></i></label>
    
    <input type="radio" id="star4" name="rating" value="2">
    <label for="star4"><i class="fas fa-star"></i></label>
    
    <input type="radio" id="star3" name="rating" value="3">
    <label for="star3"><i class="fas fa-star"></i></label>
    
    <input type="radio" id="star2" name="rating" value="4">
    <label for="star2"><i class="fas fa-star"></i></label>
    
    <input type="radio" id="star1" name="rating" value="5">
    <label for="star1"><i class="fas fa-star"></i></label>
</div>
            <br>
            <br>

            <label for="comment">Comment</label>
            <input name="comment" id="comment" type="text">
            <br>
            <input value="Rate" type="submit"></input>
        </form>
    </div>
</div>



@else
<h1 style="color:white">User session ended</h1>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js\DashboardsJS\Student\feedbackPage.js')}}"></script>
</body>
</html>
