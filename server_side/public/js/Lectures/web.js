document.getElementById('assignmentForm').addEventListener('submit', function(event) {
    event.preventDefault(); 
    var assignmentName = document.getElementById('assignmentName').value;
    alert('Assignment "' + assignmentName + '" submitted successfully!');
});