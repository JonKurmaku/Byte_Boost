document.addEventListener("DOMContentLoaded", function() {
    csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
 });


function processMentor(courseId, courseName, studentId) {
    console.log(courseId + " " + courseName + " " + studentId);
    openPopup(courseId, courseName, studentId);
}

function openPopup(courseId, courseName, studentId) {
    document.getElementById('myModal').style.display = 'block';
    function handleSubmit(event) {
        event.preventDefault();

        var status = document.querySelector('input[name="status"]:checked').value;
        if (status === "accept") {
            status = 1;
            console.log('Selected status:', status);
        } else {
            status = 0;
            console.log('Selected status:', status);
        }
        let data={
            course_id:courseId,
            course_name:courseName,
            student_id:studentId,
            status:status
        }
        console.log(data);

        closePopup();
        postMentorshipStatus(data);
        document.getElementById('popupForm').reset();
        document.getElementById('popupForm').removeEventListener('submit', handleSubmit);
    
    
    }

    document.getElementById('popupForm').addEventListener('submit', handleSubmit);
}

function closePopup() {
    document.getElementById('myModal').style.display = 'none';
}


function postMentorshipStatus(newData){
    $.ajax({
        url: '/lecturer/dashboard/mentorship/process',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: newData,
        success: function(data) {
            console.log('Data sent successfully:', data);
        },
        error: function(xhr, status, error) {
            console.error('There was a problem with the AJAX request:', error);
        }
    });
}
