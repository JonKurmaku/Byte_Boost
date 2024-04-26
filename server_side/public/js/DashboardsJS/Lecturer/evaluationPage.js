
function processData(fetchedData) {
    console.log("Fetched data:" + fetchedData);
    var studentTable = document.getElementById('studentTable');
    var tbody = document.getElementById('studentList');
    tbody.innerHTML = '';

    fetchedData.students.forEach(function(student) {
        var tr = document.createElement('tr');
        
        var tdId = document.createElement('td');
        tdId.textContent = student.id;
        tr.appendChild(tdId);

        var tdName = document.createElement('td');
        tdName.textContent = student.username;
        tr.appendChild(tdName);

        var tdFeedback = document.createElement('td');
        var finalAssessment = fetchedData.finalAssessments.find(function(assessment) {
            return assessment.student_id === student.id;
        });
        if (finalAssessment) {
            var feedbackText = '';
            for (var i = 1; i <= 5; i++) {
                feedbackText += 'Q' + i + ': ' + finalAssessment['answer_' + i] + ', ';
            }
            tdFeedback.textContent = feedbackText;
        } else {
            tdFeedback.textContent = 'No feedback available';
        }
        tr.appendChild(tdFeedback);

        tbody.appendChild(tr);
    });
}



function openPopup(courseId) {
    var popup = document.getElementById('popup');
    popup.style.display = 'block';
    fetch('/final-assessment/students/' + courseId)
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function(data) {
            processData(data)
        })
        .catch(function(error) {
            console.error('Error fetching student list:', error);
        });
}


    function closePopup() {
        var popup = document.getElementById('popup');
        popup.style.display = 'none';
    }

    function saveGrades() {
        alert('Grades saved!');
    }

    function viewAssessment(courseId) {
        alert("Assessment details for " + courseId + ".");
    }