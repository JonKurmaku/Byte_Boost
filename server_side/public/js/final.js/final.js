document.getElementById('startAssessmentBtn').addEventListener('click', function() {
    this.style.display = 'none'; 
    document.getElementById('assessmentForm').style.display = 'block'; // Show the form
    startTimer(1); 
});

function startTimer(duration) {
    var timer = duration * 60, minutes, seconds;
    var display = document.getElementById('timer');
    var interval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            clearInterval(interval);
            alert('Time is up! Submitting your answers now.');
            submitForm(); 
        }
    }, 1000);
}

document.getElementById('assessmentForm').addEventListener('submit', function(event) {
    event.preventDefault();
    clearInterval(interval); 
    
    console.log('Form submitted.');
    alert('Assessment submitted!');
});


function submitForm() {
    document.getElementById('assessmentForm').submit();
}
