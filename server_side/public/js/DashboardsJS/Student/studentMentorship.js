document.addEventListener("DOMContentLoaded", function() {
    csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
 });

function applyMentorship(courseId, studentId) {
    var postData = {
        course_id: courseId,
        student_id: studentId
    };

    $.ajax({
        url: '/student/dashboard/mentorship-apply',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: postData,
        success: function(data) {
            console.log('Data sent successfully:', data);
        },
        error: function(xhr, status, error) {
            console.error('There was a problem with the AJAX request:', error);
        }
    });
}