document.addEventListener("DOMContentLoaded", function() {
    csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
 });

function removeCourse(courseID){
console.log(courseID);

$.ajax({
    url: '/student/course/remove/' + courseID,
    method: 'DELETE',
    headers: {
        'X-CSRF-TOKEN': csrfToken
    },
    success: function(data) {
        console.log('Course deleted successfully:', data);
        window.location.reload();
    },
    error: function(xhr, status, error) {
        console.error('There was a problem with the DELETE request:', error);
        window.location.reload();
    }
});

}