document.getElementById('assignmentForm').addEventListener('submit', function(event) {
    event.preventDefault(); 
    var assignmentName = document.getElementById('assignmentName').value;
    alert('Assignment "' + assignmentName + '" submitted successfully!');
});

function enterAssessment(courseSlug){
    console.log(`/final-assessment/${courseSlug}/take`);
    window.location.href = `/final-assessment/${courseSlug}/take`;
}




  

      


