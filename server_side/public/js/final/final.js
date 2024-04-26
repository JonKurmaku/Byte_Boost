document.addEventListener("DOMContentLoaded", function() {
    csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
 });

document.getElementById('startAssessmentBtn').addEventListener('click', function() {
    this.style.display = 'none'; 
    document.getElementById('assessmentForm').style.display = 'block'; 
    startTimer(1); 
});

function startTimer(duration) {
    var timer = duration * 60, minutes, seconds;
    var display = document.getElementById('timer');
    global_interval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            clearInterval(global_interval);
            alert('Time is up! Submitting your answers now.');
            submitForm(); 
        }
    }, 1000);
}

document.getElementById('assessmentForm').addEventListener('submit', function(event) {
    event.preventDefault();
    clearInterval(global_interval);

    let _q1= document.getElementById('question1').value;
    let _q2= document.getElementById('question2').value;
    let _q3= document.getElementById('question3').value;
    let _q4= document.getElementById('question4').value;
    let _q5= document.getElementById('question5').value;

    let formData ={
        q1:_q1,
        q2:_q2,
        q3:_q3,
        q4:_q4,
        q5:_q5,
        studentId : _studentId,
        courseId : _courseId
    };

   
    console.log(formData + " " + _studentId + " " + _courseId );

    $.ajax({
        url: '/final-assessment/store',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: formData,
        success: function(data) {
            console.log('Data sent successfully:', data);
        },
        error: function(xhr, status, error) {
            console.error('There was a problem with the AJAX request:', error);
        }
    });

});

function submitForm() {
    document.getElementById('assessmentForm').submit();
}
